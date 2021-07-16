<div>
    <div>
        @can('create', App\Models\Payment::class)
        <button class="button" wire:click="newPayment">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Payment::class)
        <button
            class="button button-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="mr-1 icon ion-md-trash text-primary"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div>
                    <x-inputs.group class="w-full">
                        <x-inputs.date
                            name="paymentPayDate"
                            label="Pay Date"
                            wire:model="paymentPayDate"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="payment.type_payment"
                            label="Type Payment"
                            wire:model="payment.type_payment"
                        >
                            <option value="Online payment" {{ $selected == 'Online payment' ? 'selected' : '' }} >Online payment</option>
                            <option value="Bank payment" {{ $selected == 'Bank payment' ? 'selected' : '' }} >Bank payment</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="payment.amount"
                            label="Amount"
                            wire:model="payment.amount"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="payment.spstatus"
                            label="Spstatus"
                            wire:model="payment.spstatus"
                        >
                            <option value="Scheduled" {{ $selected == 'Scheduled' ? 'selected' : '' }} >Scheduled</option>
                            <option value="Canceled" {{ $selected == 'Canceled' ? 'selected' : '' }} >Canceled</option>
                            <option value="Delayed" {{ $selected == 'Delayed' ? 'selected' : '' }} >Delayed</option>
                            <option value="Executed" {{ $selected == 'Executed' ? 'selected' : '' }} >Executed</option>
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @endif
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModal')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="save"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <div class="block w-full overflow-auto scrolling-touch mt-4">
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead class="text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left w-1">
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.user_payments.inputs.pay_date')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.user_payments.inputs.type_payment')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.user_payments.inputs.amount')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.user_payments.inputs.spstatus')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($payments as $payment)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $payment->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $payment->pay_date ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $payment->type_payment ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $payment->amount ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $payment->spstatus ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $payment)
                            <button
                                type="button"
                                class="button"
                                wire:click="editPayment({{ $payment->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <div class="mt-10 px-4">{{ $payments->render() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
