@php $editing = isset($trip) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $trip->name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="where_address"
            label="Where Address"
            value="{{ old('where_address', ($editing ? $trip->where_address : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($trip->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="time"
            label="Time"
            value="{{ old('time', ($editing ? $trip->time : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="childrens"
            label="Childrens"
            value="{{ old('childrens', ($editing ? $trip->childrens : '0')) }}"
            max="255"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $trip->status : 'Appointed')) @endphp
            <option value="Appointed" {{ $selected == 'Appointed' ? 'selected' : '' }} >Appointed</option>
            <option value="Performed" {{ $selected == 'Performed' ? 'selected' : '' }} >Performed</option>
            <option value="Completed" {{ $selected == 'Completed' ? 'selected' : '' }} >Completed</option>
            <option value="Canceled" {{ $selected == 'Canceled' ? 'selected' : '' }} >Canceled</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="attendant_id" label="Attendant">
            @php $selected = old('attendant_id', ($editing ? $trip->attendant_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Attendant</option>
            @foreach($attendants as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="timetable_id" label="Timetable" required>
            @php $selected = old('timetable_id', ($editing ? $trip->timetable_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Timetable</option>
            @foreach($timetables as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="scheduled_wait_where"
            label="Scheduled Wait Where"
            value="{{ old('scheduled_wait_where', ($editing ? $trip->scheduled_wait_where : '')) }}"
            max="255"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="scheduled_wait_from"
            label="Scheduled Wait From"
            value="{{ old('scheduled_wait_from', ($editing ? $trip->scheduled_wait_from : '')) }}"
            max="255"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="parking_cost"
            label="Parking Cost"
            value="{{ old('parking_cost', ($editing ? $trip->parking_cost : '')) }}"
            max="255"
            required
        ></x-inputs.number>
    </x-inputs.group>
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="crmid"
            label="CRMID"
            value="{{ old('crmid', ($editing ? $trip->crmid : '')) }}"
            maxlength="50"
            required
        ></x-inputs.text>
    </x-inputs.group>
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $trip->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
    <x-inputs.group class="w-full">
        <x-inputs.select name="children[]" label="Children" multiple="true">
            @foreach($children as $id=>$child)
                <option value="{{$id}}" {{ in_array($id, $selected_children) ? 'selected' : '' }}>{{ $child }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
