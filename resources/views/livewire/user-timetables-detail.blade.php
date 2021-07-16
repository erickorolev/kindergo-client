<div>
    <div>
        @can('create', App\Models\Timetable::class)
        <button class="button" wire:click="newTimetable">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Timetable::class)
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
                            name="timetable.name"
                            label="Name"
                            wire:model="timetable.name"
                            maxlength="190"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="timetable.where_address"
                            label="Where Address"
                            wire:model="timetable.where_address"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="timetable.trips"
                            label="Trips"
                            wire:model="timetable.trips"
                            max="255"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="timetable.childrens"
                            label="Childrens"
                            wire:model="timetable.childrens"
                            max="255"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="timetable.childrens_age"
                            label="Childrens Age"
                            wire:model="timetable.childrens_age"
                            maxlength="100"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.date
                            name="timetableDate"
                            label="Date"
                            wire:model="timetableDate"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="timetable.time"
                            label="Time"
                            wire:model="timetable.time"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="timetable.duration"
                            label="Duration"
                            wire:model="timetable.duration"
                            max="255"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="timetable.distance"
                            label="Distance"
                            wire:model="timetable.distance"
                            max="255"
                            step="0.01"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="timetable.scheduled_wait_from"
                            label="Scheduled Wait From"
                            wire:model="timetable.scheduled_wait_from"
                            max="255"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="timetable.scheduled_wait_where"
                            label="Scheduled Wait Where"
                            wire:model="timetable.scheduled_wait_where"
                            max="255"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="timetable.status"
                            label="Status"
                            wire:model="timetable.status"
                        >
                            <option value="Pending" {{ $selected == 'Pending' ? 'selected' : '' }} >Pending</option>
                            <option value="Performed" {{ $selected == 'Performed' ? 'selected' : '' }} >Performed</option>
                            <option value="Completed" {{ $selected == 'Completed' ? 'selected' : '' }} >Completed</option>
                            <option value="Canceled" {{ $selected == 'Canceled' ? 'selected' : '' }} >Canceled</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.checkbox
                            name="timetable.bill_paid"
                            label="Bill Paid"
                            wire:model="timetable.bill_paid"
                        ></x-inputs.checkbox>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="timetable.description"
                            label="Description"
                            wire:model="timetable.description"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="timetable.parking_info"
                            label="Parking Info"
                            wire:model="timetable.parking_info"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @can('view-any', App\Models\Trip::class)
            <x-partials.card class="mt-5 shadow-none bg-gray-50">
                <h4 class="text-sm text-gray-600 font-bold mb-3">Trips</h4>

                <livewire:timetable-trips-detail :timetable="$timetable" />
            </x-partials.card>
            @endcan @endif
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
                        @lang('crud.user_timetables.inputs.name')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.user_timetables.inputs.where_address')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.user_timetables.inputs.trips')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.user_timetables.inputs.childrens')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.user_timetables.inputs.childrens_age')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.user_timetables.inputs.date')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.user_timetables.inputs.time')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.user_timetables.inputs.duration')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.user_timetables.inputs.distance')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.user_timetables.inputs.scheduled_wait_from')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.user_timetables.inputs.scheduled_wait_where')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.user_timetables.inputs.status')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.user_timetables.inputs.bill_paid')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.user_timetables.inputs.description')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.user_timetables.inputs.parking_info')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($timetables as $timetable)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $timetable->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $timetable->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $timetable->where_address ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $timetable->trips ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $timetable->childrens ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $timetable->childrens_age ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $timetable->date ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $timetable->time ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $timetable->duration ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $timetable->distance ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $timetable->scheduled_wait_from ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $timetable->scheduled_wait_where ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $timetable->status ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $timetable->bill_paid ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $timetable->description ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $timetable->parking_info ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $timetable)
                            <button
                                type="button"
                                class="button"
                                wire:click="editTimetable({{ $timetable->id }})"
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
                    <td colspan="16">
                        <div class="mt-10 px-4">
                            {{ $timetables->render() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
