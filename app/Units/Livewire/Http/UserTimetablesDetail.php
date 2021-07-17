<?php

namespace Units\Livewire\Http;

use App\Models\User;
use Livewire\Component;
use App\Models\Timetable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserTimetablesDetail extends Component
{
    use AuthorizesRequests;

    public User $user;
    public Timetable $timetable;
    public $timetableDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Timetable';

    protected $rules = [
        'timetable.name' => ['required', 'max:190', 'string'],
        'timetable.where_address' => ['required', 'max:255', 'string'],
        'timetable.trips' => ['required', 'numeric'],
        'timetable.childrens' => ['required', 'numeric'],
        'timetable.childrens_age' => ['required', 'max:100', 'string'],
        'timetableDate' => ['required', 'date'],
        'timetable.time' => ['required', 'date_format:H:i:s'],
        'timetable.duration' => ['required', 'numeric'],
        'timetable.distance' => ['required', 'numeric'],
        'timetable.scheduled_wait_from' => ['required', 'numeric'],
        'timetable.scheduled_wait_where' => ['required', 'numeric'],
        'timetable.status' => [
            'required',
            'in:pending,performed,completed,canceled',
        ],
        'timetable.bill_paid' => ['required', 'boolean'],
        'timetable.description' => ['required', 'max:255', 'string'],
        'timetable.parking_info' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->resetTimetableData();
    }

    public function resetTimetableData()
    {
        $this->timetable = new Timetable();

        $this->timetableDate = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newTimetable()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_timetables.new_title');
        $this->resetTimetableData();

        $this->showModal();
    }

    public function editTimetable(Timetable $timetable)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_timetables.edit_title');
        $this->timetable = $timetable;

        $this->timetableDate = $this->timetable->date->format('Y-m-d');

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

        if (!$this->timetable->user_id) {
            $this->authorize('create', Timetable::class);

            $this->timetable->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->timetable);
        }

        $this->timetable->date = \Carbon\Carbon::parse($this->timetableDate);

        $this->timetable->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Timetable::class);

        Timetable::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetTimetableData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->timetables as $timetable) {
            array_push($this->selected, $timetable->id);
        }
    }

    public function render()
    {
        return view('livewire.user-timetables-detail', [
            'timetables' => $this->user->timetables()->paginate(20),
        ]);
    }
}
