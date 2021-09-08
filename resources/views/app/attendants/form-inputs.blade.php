@php $editing = isset($attendant) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="firstname"
            label="Firstname"
            value="{{ old('firstname', ($editing ? $attendant->firstname : '')) }}"
            maxlength="190"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="lastname"
            label="Lastname"
            value="{{ old('lastname', ($editing ? $attendant->lastname : '')) }}"
            maxlength="190"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="middle_name"
            label="Middle Name"
            value="{{ old('middle_name', ($editing ? $attendant->middle_name : '')) }}"
            maxlength="190"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone"
            label="Phone"
            value="{{ old('phone', ($editing ? $attendant->phone : '')) }}"
            maxlength="20"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="resume" label="Resume" maxlength="2550" required
            >{{ old('resume', ($editing ? $attendant->resume : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="car_model"
            label="Car Model"
            value="{{ old('car_model', ($editing ? $attendant->car_model : '')) }}"
            maxlength="190"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="car_year"
            label="Car Year"
            value="{{ old('car_year', ($editing ? $attendant->car_year : '')) }}"
            maxlength="50"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $attendant->email : '')) }}"
            maxlength="100"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="gender" label="Gender">
            @php $selected = old('gender', ($editing ? $attendant->gender : 'Other')) @endphp
            <option value="Male" {{ $selected == 'Male' ? 'selected' : '' }} >Male</option>
            <option value="Female" {{ $selected == 'Female' ? 'selected' : '' }} >Female</option>
            <option value="Other" {{ $selected == 'Other' ? 'selected' : '' }} >Other</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="crmid"
            label="CrmId"
            value="{{ old('crmid', ($editing ? $attendant->crmid : '')) }}"
            maxlength="100"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="assigned_user_id"
            label="Assigned User ID"
            value="{{ old('assigned_user_id', ($editing ? $attendant->assigned_user_id : '')) }}"
            maxlength="100"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $attendant->avatar ? $attendant->avatar->getUrl() : '' }}')"
        >
            <x-inputs.partials.label
                name="imagename"
                label="Imagename"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="imagename"
                    id="imagename"
                    @change="fileChosen"
                />
            </div>

            @error('imagename') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>
</div>
