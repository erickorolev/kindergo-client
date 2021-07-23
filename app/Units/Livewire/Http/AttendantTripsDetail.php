<?php

namespace Units\Livewire\Http;

use Domains\Attendants\Models\Attendant;
use Domains\Timetables\Models\Timetable;
use Domains\Trips\Models\Trip;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AttendantTripsDetail extends Component
{
    use AuthorizesRequests;

    public Attendant $attendant;
    public Trip $trip;
    public array|Collection $timetables = [];
    public null|string $tripDate;

    public array $selected = [];
    public bool $editing = false;
    public bool $allSelected = false;
    public bool $showingModal = false;

    public string $modalTitle = 'New Trip';

    protected array $rules = [
        'trip.name' => ['required', 'max:255', 'string'],
        'trip.where_address' => ['required', 'max:255', 'string'],
        'tripDate' => ['required', 'date'],
        'trip.time' => ['required', 'date_format:H:i:s'],
        'trip.childrens' => ['required', 'numeric'],
        'trip.status' => [
            'required',
            'in:appointed,performed,completed,canceled',
        ],
        'trip.timetable_id' => ['required', 'exists:timetables,id'],
    ];

    public function mount(Attendant $attendant): void
    {
        $this->attendant = $attendant;
        $this->timetables = Timetable::pluck('name', 'id');
        $this->resetTripData();
    }

    public function resetTripData(): void
    {
        $this->trip = new Trip();

        $this->tripDate = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newTrip(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.attendant_trips.new_title');
        $this->resetTripData();

        $this->showModal();
    }

    public function editTrip(Trip $trip): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.attendant_trips.edit_title');
        $this->trip = $trip;

        $this->tripDate = $this->trip->date->format('Y-m-d');

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->trip->attendant_id) {
            $this->authorize('create', Trip::class);

            $this->trip->attendant_id = $this->attendant->id;
        } else {
            $this->authorize('update', $this->trip);
        }

        $this->trip->date = Carbon::parse($this->tripDate);

        $this->trip->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Trip::class);

        Trip::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetTripData();
    }

    /**
     * @return void
     */
    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->attendant->trips as $trip) {
            array_push($this->selected, $trip->id);
        }
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.attendant-trips-detail', [
            'trips' => $this->attendant->trips()->paginate(20),
        ]);
    }
}
