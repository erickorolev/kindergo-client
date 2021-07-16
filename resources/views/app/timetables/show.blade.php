<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.timetables.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('timetables.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.name')
                        </h5>
                        <span>{{ $timetable->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.where_address')
                        </h5>
                        <span>{{ $timetable->where_address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.trips')
                        </h5>
                        <span>{{ $timetable->trips ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.childrens')
                        </h5>
                        <span>{{ $timetable->childrens ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.childrens_age')
                        </h5>
                        <span>{{ $timetable->childrens_age ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.date')
                        </h5>
                        <span>{{ $timetable->date ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.time')
                        </h5>
                        <span>{{ $timetable->time ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.duration')
                        </h5>
                        <span>{{ $timetable->duration ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.distance')
                        </h5>
                        <span>{{ $timetable->distance ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.scheduled_wait_from')
                        </h5>
                        <span
                            >{{ $timetable->scheduled_wait_from ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.scheduled_wait_where')
                        </h5>
                        <span
                            >{{ $timetable->scheduled_wait_where ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.status')
                        </h5>
                        <span>{{ $timetable->status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.bill_paid')
                        </h5>
                        <span>{{ $timetable->bill_paid ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.description')
                        </h5>
                        <span>{{ $timetable->description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.parking_info')
                        </h5>
                        <span>{{ $timetable->parking_info ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.timetables.inputs.user_id')
                        </h5>
                        <span
                            >{{ optional($timetable->user)->name ?? '-' }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('timetables.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Timetable::class)
                    <a href="{{ route('timetables.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
