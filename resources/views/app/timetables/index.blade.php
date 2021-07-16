<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.timetables.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Timetable::class)
                            <a
                                href="{{ route('timetables.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.timetables.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.timetables.inputs.where_address')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.timetables.inputs.trips')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.timetables.inputs.childrens')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.timetables.inputs.childrens_age')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.timetables.inputs.date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.timetables.inputs.time')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.timetables.inputs.scheduled_wait_from')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.timetables.inputs.scheduled_wait_where')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.timetables.inputs.status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.timetables.inputs.bill_paid')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.timetables.inputs.user_id')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($timetables as $timetable)
                            <tr class="hover:bg-gray-50">
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
                                    {{ $timetable->scheduled_wait_from ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $timetable->scheduled_wait_where ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $timetable->status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $timetable->bill_paid ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($timetable->user)->name ?? '-'
                                    }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="relative inline-flex align-middle"
                                    >
                                        @can('update', $timetable)
                                        <a
                                            href="{{ route('timetables.edit', $timetable) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $timetable)
                                        <a
                                            href="{{ route('timetables.show', $timetable) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $timetable)
                                        <form
                                            action="{{ route('timetables.destroy', $timetable) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-trash text-red-600"
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="13">
                                    <div class="mt-10 px-4">
                                        {!! $timetables->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
