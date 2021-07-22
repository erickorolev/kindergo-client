<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.attendants.index_title')
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
                            @can('create attendants')
                            <a
                                href="{{ route('admin.attendants.create') }}"
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
                                    @lang('crud.attendants.inputs.firstname')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.attendants.inputs.latname')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.attendants.inputs.middle_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.attendants.inputs.phone')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.attendants.inputs.car_model')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.attendants.inputs.email')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.attendants.inputs.gender')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($attendants as $attendant)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $attendant->firstname ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $attendant->latname ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $attendant->middle_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $attendant->phone ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $attendant->car_model ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $attendant->email ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $attendant->gender ?? '-' }}
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
                                        @can('update attendants')
                                        <a
                                            href="{{ route('admin.attendants.edit', $attendant->id) }}"
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
                                        @endcan @can('view attendants', $attendant->id)
                                        <a
                                            href="{{ route('admin.attendants.show', $attendant->id) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete attendants', $attendant->id)
                                        <form
                                            action="{{ route('admin.attendants.destroy', $attendant->id) }}"
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
                                <td colspan="8">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <div class="mt-10 px-4">
                                        {!! $attendants->render() !!}
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
