<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.users.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('admin.users.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.name')
                        </h5>
                        <span>{{ $user->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.email')
                        </h5>
                        <span>{{ $user->email ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.firstname')
                        </h5>
                        <span>{{ $user->firstname ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.lastname')
                        </h5>
                        <span>{{ $user->lastname ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.middle_name')
                        </h5>
                        <span>{{ $user->middle_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.phone')
                        </h5>
                        <span>{{ $user->phone ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.attendant_gender')
                        </h5>
                        <span>{{ $user->attendant_gender ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.otherphone')
                        </h5>
                        <span>{{ $user->otherphone ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.users.inputs.imagename')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $user->avatar->getUrl() }}"
                            size="150"
                        />
                    </div>
                </div>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.roles.name')
                        </h5>
                        <div>
                            @forelse ($user->roles as $role)
                            <div
                                class="inline-block p-1 text-center text-sm rounded bg-blue-400 text-white"
                            >
                                {{ $role->name }}
                            </div>
                            <br />
                            @empty - @endforelse
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('admin.users.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create users')
                    <a href="{{ route('admin.users.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
{{--            @can('list timetables')
                <x-partials.card class="mt-5">
                    <x-slot name="title"> Timetables </x-slot>

                    <livewire:user-timetables-detail :user="$user" />
                </x-partials.card>
            @endcan
            @can('list payments')
                <x-partials.card class="mt-5">
                    <x-slot name="title"> Payments </x-slot>

                    <livewire:user-payments-detail :user="$user" />
                </x-partials.card>
            @endcan--}}
        </div>
    </div>
</x-app-layout>
