@php $editing = isset($timetable) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $timetable->name : '')) }}"
            maxlength="190"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="where_address"
            label="Where Address"
            value="{{ old('where_address', ($editing ? $timetable->where_address : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="trips"
            label="Trips"
            value="{{ old('trips', ($editing ? $timetable->trips : '')) }}"
            max="255"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="childrens"
            label="Childrens"
            value="{{ old('childrens', ($editing ? $timetable->childrens : '')) }}"
            max="255"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="childrens_age"
            label="Childrens Age"
            value="{{ old('childrens_age', ($editing ? $timetable->childrens_age : '')) }}"
            maxlength="100"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($timetable->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="time"
            label="Time"
            value="{{ old('time', ($editing ? $timetable->time : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="duration"
            label="Duration"
            value="{{ old('duration', ($editing ? $timetable->duration : '')) }}"
            max="255"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="distance"
            label="Distance"
            value="{{ old('distance', ($editing ? $timetable->distance : '')) }}"
            max="255"
            step="0.01"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="scheduled_wait_from"
            label="Scheduled Wait From"
            value="{{ old('scheduled_wait_from', ($editing ? $timetable->scheduled_wait_from : '')) }}"
            max="255"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="scheduled_wait_where"
            label="Scheduled Wait Where"
            value="{{ old('scheduled_wait_where', ($editing ? $timetable->scheduled_wait_where : '')) }}"
            max="255"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $timetable->status : 'Pending')) @endphp
            <option value="Pending" {{ $selected == 'Pending' ? 'selected' : '' }} >Pending</option>
            <option value="Performed" {{ $selected == 'Performed' ? 'selected' : '' }} >Performed</option>
            <option value="Completed" {{ $selected == 'Completed' ? 'selected' : '' }} >Completed</option>
            <option value="Canceled" {{ $selected == 'Canceled' ? 'selected' : '' }} >Canceled</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="bill_paid"
            label="Bill Paid"
            :checked="old('bill_paid', ($editing ? $timetable->bill_paid : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $timetable->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="parking_info"
            label="Parking Info"
            maxlength="255"
            required
            >{{ old('parking_info', ($editing ? $timetable->parking_info : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="crmid"
            label="CrmId"
            value="{{ old('crmid', ($editing ? $timetable->crmid : '')) }}"
            maxlength="100"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="assigned_user_id"
            label="Assigned User ID"
            value="{{ old('assigned_user_id', ($editing ? $timetable->assigned_user_id : '')) }}"
            maxlength="100"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="children[]" label="Children" multiple="true">
            @foreach($children as $id=>$child)
                <option value="{{$id}}" {{ in_array($id, $selected_children) ? 'selected' : '' }}>{{ $child }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User">
            @php $selected = old('user_id', ($editing ? $timetable->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
