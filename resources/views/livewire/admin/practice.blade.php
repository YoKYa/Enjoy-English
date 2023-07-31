<div>
    {{ Breadcrumbs::render('admin.practice', $materi->slug) }}
    @push('pageTitle', "Admin - Practice - ")
    <div class="flex flex-col" x-data="{ open: false }">
        {{-- Practice --}}
        <div class="rounded border border-gray-200">
            @php $no = 1; @endphp
            @foreach ($practices as $pract)
            <div class="flex flex-row p-2">
                <div class="w-1/12 flex justify-center items-center border-r-2">{{ $no++ }}</div>
                <div class="flex flex-col p-2 w-11/12">
                    <div class="flex justify-between ">
                        <div class="uppercase text-lg">TYPE : {{ $pract->type }}</div>
                        @if ($practice == null)
                        <button class="text-red-500" wire:click='deletePractice({{ $pract->id }})'>Delete</button>
                        @elseif($practice->id != $pract->id)
                        <button class="text-red-500" wire:click='deletePractice({{ $pract->id }})'>Delete</button>
                        @endif
                    </div>
                    <hr />
                    @php
                    $l = 1;
                    @endphp
                    <div class="flex flex-wrap items-center">
                        @foreach ($pract->pquestion as $question)
                        @if ($question->line != $l)
                        @php
                        $l = $question->line;
                        @endphp
                        <div class="w-full h-0"></div>
                        <div>{{ $question->data }}</div>
                        @else
                        @if ($question->type == 'text')
                        <div>{{ $question->data }}</div>&nbsp;
                        @elseif($question->type == 'picture')
                        <img class="w-48 mx-2" src="{{ asset('storage/'.$question->data) }}" alt="">
                        @elseif($question->type == 'audio')
                        {{ $question->data }}
                        @endif

                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <hr class="border border-gray-200">
            @endforeach
        </div>

        {{-- Type --}}
        <div class="rounded border border-gray-200 flex flex-col mt-2" x-show="open">
            @if ($practice == null)
            @elseif($practice->type == 'speaking')
            <div class="flex flex-col">
                <div x-data="{
                        open: false,
                        toggle() {
                            if (this.open) {
                                return this.close()
                            }
                            this.$refs.button.focus()
                            this.open = true
                        },
                        close(focusAfter) {
                            if (! this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']"
                    class="relative p-2">

                    <!-- Button -->
                    <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                        :aria-controls="$id('dropdown-button')" type="button"
                        class="mx-4 flex items-center border-blue-400 border gap-2 bg-white px-5 rounded-md shadow">
                        <img class="w-12 h-12 cursor-pointer" src="{{ asset('svg/plus.svg') }}" alt="Plus">
                    </button>
                    <!-- Panel -->
                    <div x-ref="panel" x-show="open" x-transition.origin.top.left
                        x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" style="display: none;"
                        class="absolute left-28 mt-2 w-40 rounded-md bg-white shadow-md top-0">
                        <button wire:click="addQuestion('text')"
                            class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                            Text
                        </button>
                        <button wire:click="addQuestion('picture')"
                            class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                            Picture
                        </button>
                        <button wire:click="addQuestion('audio')"
                            class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                            Audio
                        </button>
                    </div>
                </div>
            </div>
            @elseif($practice->type == 'grammar')
            @else
            <div class="flex w-full">
                <button wire:click="typePractice('speaking')"
                    class="hover:text-white uppercase w-1/2 border border-gray-200rounded m-2 p-4 flex justify-center items-center hover:bg-biru-3 duration-200 ease-in-out">
                    <img src="{{ asset('svg/headphone.svg') }}" alt="headphone" class="w-16 h-16">
                    <div class="m-6">Speaking</div>
                </button>
                <button wire:click="typePractice('grammar')"
                    class="hover:text-white uppercase w-1/2 border border-gray-200rounded m-2 p-4 flex justify-center items-center hover:bg-biru-3 duration-200 ease-in-out">
                    <img src="{{ asset('svg/file.svg') }}" alt="file" class="w-16 h-16">
                    <div class="m-6">Grammar</div>
                </button>
            </div>
            @endif

        </div>

        {{-- Add Button --}}
        <div x-show="!open">
            <button x-on:click="open = !open" wire:click='addPractice'
                class=" mt-4 uppercase w-full bg-biru-3 text-white p-2 rounded hover:bg-biru-2">Add Practice</button>
        </div>
        <div x-show="open">
            <button x-on:click="open = !open" wire:click='deletePractice'
                class=" mt-4 uppercase w-full bg-red-500 text-white p-2 rounded hover:bg-red-600">Delete
                Practice</button>
            <button wire:click='addPractice'
                class=" mt-4 uppercase w-full bg-biru-3 text-white p-2 rounded hover:bg-biru-2">Add Practice</button>
        </div>
    </div>
    <x-add-textpractice class="text-white p-2 rounded-md">
        <x-slot name="title">
            Text Practice
        </x-slot>
        <x-slot name="form">
            <!-- Text -->
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="data" value="{{ __('Add Text') }}" />
                <x-input id="data" type="text" class="mt-1 block w-full" wire:model.defer="data" required
                    autocomplete="data" />
                <x-input-error for="data" class="mt-2" />
            </div>
            <!-- Text -->
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="line" value="{{ __('Line') }}" />
                <x-input id="line" type="number" class="mt-1 block w-full" wire:model.defer="line" required
                    autocomplete="line" />
                <x-input-error for="line" class="mt-2" />
            </div>
        </x-slot>
    </x-add-textpractice>
    <x-add-picturepractice class="text-white p-2 rounded-md">
        <x-slot name="title">
            Picture Practice
        </x-slot>
        <x-slot name="form">
            <!-- Picture -->
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="data" value="{{ __('Add Picture') }}" />

                <div
                    class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed  rounded cursor-pointer">
                    <x-input accept=" image/*" id="data" type="file"
                        class="bg-blue-400 absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                        wire:model.defer="data" required autocomplete="data" />
                    <div class="flex flex-col items-center justify-center py-10 text-center">
                        <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="m-0">Drag your files here or click in this area.</p>
                    </div>
                </div>
                @if ($data && $type == 'picture')
                <div
                    class="relative flex flex-col items-center w-full h-64 mt-4 overflow-hidden text-center bg-gray-100 border rounded select-none">
                    <button wire:click="deletePicture"
                        class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none" type="button">
                        <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    <img class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                        src="{{ $data->temporaryUrl() }}" />
                </div>
                @endif
                <x-input-error for="data" class="mt-2" />
            </div>
            <!-- Line -->
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="line" value="{{ __('Line') }}" />
                <x-input id="line" type="number" class="mt-1 block w-full" wire:model.defer="line" required
                    autocomplete="line" />
                <x-input-error for="line" class="mt-2" />
            </div>
        </x-slot>
    </x-add-picturepractice>
    <x-add-audiopractice class="text-white p-2 rounded-md">
        <x-slot name="title">
            Audio Practice
        </x-slot>
        <x-slot name="form">
            <!-- Picture -->
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="data" value="{{ __('Add Audio/Record') }}" />
                <div
                    class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed  rounded cursor-pointer">
                    <x-input accept=" audio/*" id="data" type="file"
                        class="bg-blue-400 absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                        wire:model.defer="data" required autocomplete="data" />
                    <div class="flex flex-col items-center justify-center py-10 text-center">
                        <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="m-0">Drag your files here or click in this area.</p>
                    </div>
                </div>
                @if ($data && $type == 'picture')
                <div
                    class="relative flex flex-col items-center w-full h-64 mt-4 overflow-hidden text-center bg-gray-100 border rounded select-none">
                    <button wire:click="deletePicture"
                        class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none" type="button">
                        <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    <img class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                        src="{{ $data->temporaryUrl() }}" />
                </div>
                @endif
                <x-input-error for="data" class="mt-2" />
            </div>
            <!-- Line -->
            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="line" value="{{ __('Line') }}" />
                <x-input id="line" type="number" class="mt-1 block w-full" wire:model.defer="line" required
                    autocomplete="line" />
                <x-input-error for="line" class="mt-2" />
            </div>
        </x-slot>
    </x-add-audiopractice>
</div>