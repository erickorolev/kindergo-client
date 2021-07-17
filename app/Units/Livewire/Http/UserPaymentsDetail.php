<?php

namespace Units\Livewire\Http;

use App\Models\User;
use Livewire\Component;
use App\Models\Payment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserPaymentsDetail extends Component
{
    use AuthorizesRequests;

    public User $user;
    public Payment $payment;
    public $paymentPayDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Payment';

    protected $rules = [
        'paymentPayDate' => ['required', 'date'],
        'payment.type_payment' => [
            'required',
            'in:online payment,bank payment',
        ],
        'payment.amount' => ['required', 'max:255'],
        'payment.spstatus' => [
            'required',
            'in:scheduled,canceled,delayed,executed',
        ],
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->resetPaymentData();
    }

    public function resetPaymentData()
    {
        $this->payment = new Payment();

        $this->paymentPayDate = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newPayment()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_payments.new_title');
        $this->resetPaymentData();

        $this->showModal();
    }

    public function editPayment(Payment $payment)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_payments.edit_title');
        $this->payment = $payment;

        $this->paymentPayDate = $this->payment->pay_date->format('Y-m-d');

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

        if (!$this->payment->user_id) {
            $this->authorize('create', Payment::class);

            $this->payment->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->payment);
        }

        $this->payment->pay_date = \Carbon\Carbon::parse($this->paymentPayDate);

        $this->payment->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Payment::class);

        Payment::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetPaymentData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->payments as $payment) {
            array_push($this->selected, $payment->id);
        }
    }

    public function render()
    {
        return view('livewire.user-payments-detail', [
            'payments' => $this->user->payments()->paginate(20),
        ]);
    }
}
