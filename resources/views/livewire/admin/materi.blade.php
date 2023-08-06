<div>
    {{-- Breadcrumbs --}}
    {{ Breadcrumbs::render('admin.materi', $topic->id) }}

    @push('pageTitle', "Admin - $topic->name - ")
    <div class="flex justify-between items-center">
        <div class="text-xl uppercase">{{ $topic->name }}</div>
        <x-add-materi wire:click='addMateri'>
            <x-slot name="name">
                Create Materi
            </x-slot>
            <x-slot name="form">
                <input type="text" wire:model='userId' hidden>
                <!-- Title -->
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-label for="title" value="{{ __('Title') }}" />
                    <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" required
                        autocomplete="title" />
                    <x-input-error for="title" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-label for="description" value="{{ __('Description') }}" />
                    <textarea id="description" type="textarea"
                        class="mt-1 block w-full shadow-sm rounded-lg border-gray-300" wire:model.defer="description"
                        required autocomplete="description"> </textarea>
                    <x-input-error for="description" class="mt-2" />
                </div>
                <!-- Order -->
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-label for="order" value="{{ __('Order') }}" />
                    <x-input id="order" type="number" class="mt-1 block w-full" wire:model.defer="order" required
                        autocomplete="order" />
                    <x-input-error for="order" class="mt-2" />
                </div>
            </x-slot>
            <button class="w-10 h-10">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#162ddf">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path opacity="0.1"
                            d="M3 12C3 4.5885 4.5885 3 12 3C19.4115 3 21 4.5885 21 12C21 19.4115 19.4115 21 12 21C4.5885 21 3 19.4115 3 12Z"
                            fill="#1b4dc0"></path>
                        <path d="M9 12H15" stroke="#1b4dc0" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>
                        <path d="M12 9L12 15" stroke="#1b4dc0" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>
                        <path
                            d="M3 12C3 4.5885 4.5885 3 12 3C19.4115 3 21 4.5885 21 12C21 19.4115 19.4115 21 12 21C4.5885 21 3 19.4115 3 12Z"
                            stroke="#1b4dc0" stroke-width="2"></path>
                    </g>
                </svg>
            </button>
        </x-add-materi>
    </div>

    @if (session()->has('message'))
    <div class="text-green-900 bg-green-400 px-4 py-2 my-4 rounded-lg">
        {{ session('message') }}
    </div>
    @endif
    <div class="border-2 border-gray-500 shadow rounded-lg h-auto p-8 grid grid-cols-2 gap-4">
        @php $no = 0 @endphp
        @foreach ($materis as $materi)
        <div class="w-full p-4 rounded-lg border-gray-400 border-2 shadow-lg hover:scale-105 duration-150 ease-in-out">
            <div class="flex justify-between">
                <div class="p-2 uppercase underline">({{ $materi->order }}) Materi {{++$no }} </div>
                <div class="flex">
                    <div class=" text-white p-2 rounded-md w-10 h-10">
                        <button class="w-6 h-6" wire:click='editMateri({{ $materi->id }})'>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z"
                                        stroke="#0a23e6" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                    <path
                                        d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13"
                                        stroke="#0a23e6" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                </g>
                            </svg>
                        </button>
                    </div>
                    <div class=" text-white p-2 rounded-md w-10 h-10">
                        <button class="w-6 h-6" wire:click='deleteMateri({{ $materi->id }})'>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M3 6.98996C8.81444 4.87965 15.1856 4.87965 21 6.98996" stroke="#ff1414"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M8.00977 5.71997C8.00977 4.6591 8.43119 3.64175 9.18134 2.8916C9.93148 2.14146 10.9489 1.71997 12.0098 1.71997C13.0706 1.71997 14.0881 2.14146 14.8382 2.8916C15.5883 3.64175 16.0098 4.6591 16.0098 5.71997"
                                        stroke="#ff1414" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                    <path d="M12 13V18" stroke="#ff1414" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M19 9.98999L18.33 17.99C18.2225 19.071 17.7225 20.0751 16.9246 20.8123C16.1266 21.5494 15.0861 21.9684 14 21.99H10C8.91389 21.9684 7.87336 21.5494 7.07541 20.8123C6.27745 20.0751 5.77745 19.071 5.67001 17.99L5 9.98999"
                                        stroke="#ff1414" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                </g>
                            </svg>
                        </button>
                    </div>
                    <div class=" text-white p-2 rounded-md w-10 h-10">
                        @if ($materi->publish == false)
                        <button class="w-6 h-6" wire:click='publishMateri({{ $materi->id }})'>
                            <svg version="1.1" id="Uploaded to svgrepo.com" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"
                                fill="#009425" stroke="#009425">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <style type="text/css">
                                        .feather_een {
                                            fill: #0B1719;
                                        }
                                    </style>
                                    <path class="feather_een"
                                        d="M27.257,4.097l-16.331,6.534C10.779,10.262,10.422,10,10,10H5c-0.552,0-1,0.448-1,1v0H3 c-1.105,0-2,0.895-2,2v4c0,1.105,0.895,2,2,2l1,0c0,0.552,0.448,1,1,1v2c0,1.657,1.343,3,3,3h4c1.657,0,3-1.343,3-3v-1l12.257,4.903 C28.571,26.428,30,25.461,30,24.046V5.954C30,4.539,28.571,3.572,27.257,4.097z M4,18H3c-0.552,0-1-0.448-1-1v-4 c0-0.552,0.448-1,1-1h1V18z M10.925,19.371L12,19.8V22H8l0-2h2C10.421,20,10.777,19.739,10.925,19.371z M5,11h5v8l-5,0V11z M12,24H8 c-1.105,0-2-0.895-2-2v-2h1l0,2c0,0.552,0.448,1,1,1h4c0.552,0,1-0.448,1-1v-1.8l1,0.4V22C14,23.105,13.104,24,12,24z M27.629,24.974L11,18.323v-6.646l16.629-6.651C28.285,4.763,29,5.247,29,5.954v18.092C29,24.753,28.285,25.237,27.629,24.974z">
                                    </path>
                                </g>
                            </svg>
                        </button>
                        @endif

                    </div>
                </div>
            </div>
            <div class="text-2xl text-gray-700 my-5 p-2 uppercase">{{ $materi->title }}</div>
            <div class="flex justify-between">
                <a href="{{ route('admin.lessons', $materi->slug) }}"
                    class="py-2 px-6 hover:bg-green-800 shadow-md duration-100 ease-in-out bg-green-600 rounded-lg text-white">Lesson</a>
                <a href="{{ route('admin.practice', $materi->slug) }}"
                    class="py-2 px-6 hover:bg-blue-800 shadow-md duration-100 ease-in-out bg-blue-600 rounded-lg text-white">Practice</a>
                <a href="{{ route('admin.test', $materi->slug) }}"
                    class="py-2 px-6 hover:bg-orange-800 shadow-md duration-100 ease-in-out bg-orange-600 rounded-lg text-white">Test</a>
            </div>
        </div>
        @endforeach
    </div>
    <x-edit-materi class="text-white p-2 rounded-md">
        <x-slot name="editname">
            Edit Materi
        </x-slot>
        <x-slot name="editform">
            <!-- Title -->
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" required
                    autocomplete="title" />
                <x-input-error for="title" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="description" value="{{ __('Description') }}" />
                <textarea id="description" type="textarea"
                    class="mt-1 block w-full shadow-sm rounded-lg border-gray-300" wire:model.defer="description"
                    required autocomplete="description"> </textarea>
                <x-input-error for="description" class="mt-2" />
            </div>
            <!-- Order -->
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="order" value="{{ __('Order') }}" />
                <x-input id="order" type="number" class="mt-1 block w-full" wire:model.defer="order" required
                    autocomplete="order" />
                <x-input-error for="order" class="mt-2" />
            </div>
        </x-slot>

    </x-edit-materi>
    <x-delete-materi class="text-white p-2 rounded-md">
        <x-slot name="name">
            Delete Materi
        </x-slot>
        <x-slot name="form">
            Are you sure delete this materi?
            @isset($title)
            {{ $title }}
            @endisset
        </x-slot>
    </x-delete-materi>
    <x-publish-materi class="text-white p-2 rounded-md">
        <x-slot name="name">
            Publish Materi
        </x-slot>
        <x-slot name="form">
            Are you sure publish this materi?
            @isset($title)
            {{ $title }}
            @endisset
        </x-slot>
    </x-publish-materi>
</div>