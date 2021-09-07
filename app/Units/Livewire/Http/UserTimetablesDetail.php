<?php

namespace Units\Livewire\Http;

use Domains\Timetables\Models\Timetable;
use Domains\Users\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserTimetablesDetail extends Component
{
    use AuthorizesRequests;

    public User $user;
    public Timetable $timetable;
    public null|string $timetableDate;

    public array $selected = [];
    public bool $editing = false;
    public bool $allSelected = false;
    public bool $showingModal = false;

    public string $modalTitle = 'New Timetable';

    protected array $rules = [
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

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->resetTimetableData();
    }

    public function resetTimetableData(): void
    {
        $this->timetable = new Timetable();

        $this->timetableDate = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newTimetable(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_timetables.new_title');
        $this->resetTimetableData();

        $this->showModal();
    }

    public function editTimetable(Timetable $timetable): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_timetables.edit_title');
        $this->timetable = $timetable;

        $this->timetableDate = $this->timetable->date;

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

        if (!$this->timetable->user_id) {
            $this->authorize('create', Timetable::class);

            $this->timetable->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->timetable);
        }

        $this->timetable->date = $this->timetableDate;

        $this->timetable->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Timetable::class);

        Timetable::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetTimetableData();
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

        foreach ($this->user->timetables as $timetable) {
            array_push($this->selected, $timetable->id);
        }
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.user-timetables-detail', [
            'timetables' => $this->user->timetables()->paginate(20),
        ]);
    }
}
