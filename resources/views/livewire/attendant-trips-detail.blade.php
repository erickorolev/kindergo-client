<div>
    <div>
        @can('create', App\Models\Trip::class)
        <button class="button" wire:click="newTrip">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Trip::class)
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
                        <x-inputs.text
                            name="trip.name"
                            label="Name"
                            wire:model="trip.name"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="trip.where_address"
                            label="Where Address"
                            wire:model="trip.where_address"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.date
                            name="tripDate"
                            label="Date"
                            wire:model="tripDate"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="trip.time"
                            label="Time"
                            wire:model="trip.time"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="trip.childrens"
                            label="Childrens"
                            wire:model="trip.childrens"
                            max="255"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="trip.status"
                            label="Status"
                            wire:model="trip.status"
                        >
                            <option value="Appointed" {{ $selected == 'Appointed' ? 'selected' : '' }} >Appointed</option>
                            <option value="Performed" {{ $selected == 'Performed' ? 'selected' : '' }} >Performed</option>
                            <option value="Completed" {{ $selected == 'Completed' ? 'selected' : '' }} >Completed</option>
                            <option value="Canceled" {{ $selected == 'Canceled' ? 'selected' : '' }} >Canceled</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="trip.timetable_id"
                            label="Timetable"
                            wire:model="trip.timetable_id"
                        >
                            <option value="null" disabled>Please select the Timetable</option>
                            @foreach($timetables as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
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
                        @lang('crud.attendant_trips.inputs.name')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.attendant_trips.inputs.where_address')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.attendant_trips.inputs.date')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.attendant_trips.inputs.time')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.attendant_trips.inputs.childrens')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.attendant_trips.inputs.status')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.attendant_trips.inputs.timetable_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($trips as $trip)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $trip->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $trip->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $trip->where_address ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $trip->date ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $trip->time ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $trip->childrens ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $trip->status ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($trip->timetable)->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $trip)
                            <button
                                type="button"
                                class="button"
                                wire:click="editTrip({{ $trip->id }})"
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
                    <td colspan="8">
                        <div class="mt-10 px-4">{{ $trips->render() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
