@php $editing = isset($payment) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.date
            name="pay_date"
            label="Pay Date"
            value="{{ old('pay_date', ($editing ? optional($payment->pay_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="type_payment" label="Type Payment">
            @php $selected = old('type_payment', ($editing ? $payment->type_payment : 'Online payment')) @endphp
            <option value="Online payment" {{ $selected == 'Online payment' ? 'selected' : '' }} >Online payment</option>
            <option value="Bank payment" {{ $selected == 'Bank payment' ? 'selected' : '' }} >Bank payment</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="amount"
            label="Amount"
            value="{{ old('amount', ($editing ? $payment->amount : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="spstatus" label="Spstatus">
            @php $selected = old('spstatus', ($editing ? $payment->spstatus : 'Scheduled')) @endphp
            <option value="Scheduled" {{ $selected == 'Scheduled' ? 'selected' : '' }} >Scheduled</option>
            <option value="Canceled" {{ $selected == 'Canceled' ? 'selected' : '' }} >Canceled</option>
            <option value="Delayed" {{ $selected == 'Delayed' ? 'selected' : '' }} >Delayed</option>
            <option value="Executed" {{ $selected == 'Executed' ? 'selected' : '' }} >Executed</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $payment->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
