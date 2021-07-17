<?php

namespace Units\Livewire\Http;

use App\Models\Trip;
use Livewire\Component;
use App\Models\Timetable;
use App\Models\Attendant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TimetableTripsDetail extends Component
{
    use AuthorizesRequests;

    public Timetable $timetable;
    public Trip $trip;
    public $timetableAttendants = [];
    public $tripDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Trip';

    protected $rules = [
        'trip.name' => ['required', 'max:255', 'string'],
        'trip.where_address' => ['required', 'max:255', 'string'],
        'tripDate' => ['required', 'date'],
        'trip.time' => ['required', 'date_format:H:i:s'],
        'trip.childrens' => ['required', 'numeric'],
        'trip.status' => [
            'required',
            'in:appointed,performed,completed,canceled',
        ],
        'trip.attendant_id' => ['nullable', 'exists:attendants,id'],
    ];

    public function mount(Timetable $timetable)
    {
        $this->timetable = $timetable;
        $this->timetableAttendants = Attendant::pluck('firstname', 'id');
        $this->resetTripData();
    }

    public function resetTripData()
    {
        $this->trip = new Trip();

        $this->tripDate = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newTrip()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.timetable_trips.new_title');
        $this->resetTripData();

        $this->showModal();
    }

    public function editTrip(Trip $trip)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.timetable_trips.edit_title');
        $this->trip = $trip;

        $this->tripDate = $this->trip->date->format('Y-m-d');

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->trip->timetable_id) {
            $this->authorize('create', Trip::class);

            $this->trip->timetable_id = $this->timetable->id;
        } else {
            $this->authorize('update', $this->trip);
        }

        $this->trip->date = \Carbon\Carbon::parse($this->tripDate);

        $this->trip->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Trip::class);

        Trip::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetTripData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->timetable->trips as $trip) {
            array_push($this->selected, $trip->id);
        }
    }

    public function render()
    {
        return view('livewire.timetable-trips-detail', [
            'trips' => $this->timetable->trips()->paginate(20),
        ]);
    }
}
