<div>
    {{-- Breadcrumbs --}}
    {{ Breadcrumbs::render('admin.users') }}
    {{-- Content --}}
    <div class="card ">
        <header class="card-header noborder">
            <h4 class="card-title text-lg uppercase px-4">Users</h4>
        </header>
        @if (session()->has('message'))
        <div class="text-green-900 bg-green-400 px-4 py-2 my-4 mx-6 rounded-lg">
            {{ session('message') }}
        </div>
        @endif
        <div class="card-body pb-6 ">
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">No.</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Kelas</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Role</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        <?php $no = 1; ?>
                        @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <th class="px-6 py-4 font-normal text-gray-900">{{ $no++ }}</th>
                            <th class="px-6 py-4 font-normal text-gray-900">{{ $user->id }}</th>
                            <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                <div class="text-sm">
                                    <div class="font-medium text-gray-700">{{ $user->name }}</div>
                                    <div class="text-gray-400">{{ $user->email }}</div>
                                </div>
                            </th>
                            <td class="px-6 py-4">{{ $user->class }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-md font-semibold text-green-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                    {{ $user->roles }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-4">
                                    <x-edit-user wire:click='editUser({{ $user }})'>
                                        <x-slot name="name">
                                            Edit User @if($selectedUser !== null) {{ $selectedUser->name }} @endif
                                        </x-slot>
                                        <x-slot name="form">
                                            <input type="text" wire:model='userId' hidden>
                                            <!-- Name -->
                                            <div class="col-span-6 sm:col-span-4 mt-2">
                                                <x-label for="name" value="{{ __('Name') }}" />
                                                <x-input id="name" type="text" class="mt-1 block w-full"
                                                    wire:model.defer="name" required autocomplete="name" />
                                                <x-input-error for="name" class="mt-2" />
                                            </div>
                                            <!-- Email -->
                                            <div class="col-span-6 sm:col-span-4 mt-2">
                                                <x-label for="email" value="{{ __('Email') }}" />
                                                <x-input id="email" type="email" class="mt-1 block w-full"
                                                    wire:model.defer="email" required autocomplete="username" />
                                                <x-input-error for="email" class="mt-2" />
                                            </div>
                                            <!-- Class -->
                                            <div class="col-span-6 sm:col-span-4 mt-2">
                                                <x-label for="class" value="{{ __('Class') }}" />
                                                <x-input id="class" type="text" class="mt-1 block w-full"
                                                    wire:model.defer="class" required autocomplete="class" />
                                                <x-input-error for="class" class="mt-2" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-4 mt-2">
                                                <x-label for="roles" value="{{ __('Roles') }}" />
                                                <select wire:model='roles'
                                                    class="mt-1 block w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white "
                                                    id="roles">
                                                    <option @if($user->roles == 'admin') selected @endif
                                                        value="admin">admin</option>
                                                    <option @if($user->roles == 'user') selected @endif
                                                        value="user">user</option>
                                                </select>
                                            </div>
                                        </x-slot>
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6"
                                                x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                        </button>
                                    </x-edit-user>
                                    <x-delete-user wire:click='deleteUser({{ $user }})'>
                                        <x-slot name="name">
                                            Delete User
                                        </x-slot>
                                        <x-slot name="form">
                                            @if($selectedUser !== null) {{ $selectedUser->name }} @endif
                                        </x-slot>
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6"
                                                x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </x-delete-user>
                                </div>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>