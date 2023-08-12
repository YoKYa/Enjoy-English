<div>
    {{ Breadcrumbs::render('admin.practice', $materi->slug) }}
    @push('pageTitle', "Admin - Practice - ")
    <div class="flex flex-col" x-data="{ open: false }">
        {{-- Practice --}}
        <div class="border border-gray-200 rounded">
            @php $no = 1; @endphp
            @foreach ($practices as $pract)
            <div class="flex flex-row p-2">
                <div class="flex items-center justify-center w-1/12 border-r-2">{{ $no++ }}</div>
                <div class="flex flex-col w-11/12 p-2">
                    <div class="flex justify-between ">
                        <div class="flex items-center text-lg uppercase">TYPE : {{ $pract->type }}
                        </div>

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
                        @if ($question->type == 'text')
                        <div>{{ $question->data }}</div>&nbsp;
                        @elseif($question->type == 'picture')
                        <img class="w-48 mx-2" src="{{ asset('storage/'.$question->data) }}" alt="">
                        @elseif($question->type == 'audio')
                        <audio controls class="mx-4 my-1">
                            <source src="{{ asset('storage/'.$question->data) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                        @endif
                        @else
                        @if ($question->type == 'text')
                        <div>{{ $question->data }}</div>&nbsp;
                        @elseif($question->type == 'picture')
                        <img class="w-48 mx-2" src="{{ asset('storage/'.$question->data) }}" alt="">
                        @elseif($question->type == 'audio')
                        <audio controls class="mx-4 my-1">
                            <source src="{{ asset('storage/'.$question->data) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
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
        <div class="flex flex-col mt-2 border border-gray-200 rounded" x-show="open">
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
                    <div class="flex">
                        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')" type="button"
                            class="flex items-center gap-2 px-5 mx-4 bg-white border border-blue-400 rounded-md shadow">
                            <img class="w-12 h-12 cursor-pointer" src="{{ asset('svg/plus.svg') }}" alt="Plus">
                            Add Question
                        </button>

                    </div>
                    <!-- Panel -->
                    <div x-ref="panel" x-show="open" x-transition.origin.top.left
                        x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" style="display: none;"
                        class="absolute top-0 w-40 mt-2 bg-white rounded-md shadow-md left-28">
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
                    <div class="flex">
                        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')" type="button"
                            class="flex items-center gap-2 px-5 mx-4 bg-white border border-blue-400 rounded-md shadow">
                            <img class="w-12 h-12 cursor-pointer" src="{{ asset('svg/plus.svg') }}" alt="Plus">
                            Add Text/Pict/Audio
                        </button>
                        <button x-ref="button" wire:click="$emit('modal', {{ $practice->id }})" :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')" type="button"
                            class="flex items-center gap-2 px-5 mx-4 bg-white border border-blue-400 rounded-md shadow">
                            <img class="w-12 h-12 cursor-pointer" src="{{ asset('svg/plus.svg') }}" alt="Plus">
                            Add Answer
                        </button>
                    </div>
                    <!-- Panel -->
                    <div x-ref="panel" x-show="open" x-transition.origin.top.left
                        x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" style="display: none;"
                        class="absolute top-0 w-40 mt-2 bg-white rounded-md shadow-md left-28">
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
            @else
            <div class="flex w-full">
                <button wire:click="typePractice('speaking')"
                    class="flex items-center justify-center w-1/2 p-4 m-2 uppercase duration-200 ease-in-out border hover:text-white border-gray-200rounded hover:bg-biru-3">
                    <img src="{{ asset('svg/headphone.svg') }}" alt="headphone" class="w-16 h-16">
                    <div class="m-6">Speaking</div>
                </button>
                <button wire:click="typePractice('grammar')"
                    class="flex items-center justify-center w-1/2 p-4 m-2 uppercase duration-200 ease-in-out border hover:text-white border-gray-200rounded hover:bg-biru-3">
                    <img src="{{ asset('svg/file.svg') }}" alt="file" class="w-16 h-16">
                    <div class="m-6">Grammar</div>
                </button>
            </div>
            @endif

        </div>

        {{-- Add Button --}}
        <div x-show="!open">
            <button x-on:click="open = !open" wire:click='addPractice'
                class="w-full p-2 mt-4 text-white uppercase rounded  bg-biru-3 hover:bg-biru-2">Add Practice</button>
        </div>
        <div x-show="open">
            <button x-on:click="open = !open" wire:click='deletePractice'
                class="w-full p-2 mt-4 text-white uppercase bg-red-500 rounded  hover:bg-red-600">Delete
                Practice</button>
            <button wire:click='addPractice'
                class="w-full p-2 mt-4 text-white uppercase rounded  bg-biru-3 hover:bg-biru-2">Add Practice</button>
        </div>
    </div>
    <x-add-textpractice class="p-2 text-white rounded-md">
        <x-slot name="title">
            Text Practice
        </x-slot>
        <x-slot name="form">
            <!-- Text -->
            <div class="col-span-6 mt-2 sm:col-span-4">
                <x-label for="data" value="{{ __('Add Text') }}" />
                <x-input id="data" type="text" class="block w-full mt-1" wire:model.defer="data" required
                    autocomplete="data" />
                <x-input-error for="data" class="mt-2" />
            </div>
            <!-- Text -->
            <div class="col-span-6 mt-2 sm:col-span-4">
                <x-label for="line" value="{{ __('Line') }}" />
                <x-input id="line" type="number" class="block w-full mt-1" wire:model.defer="line" required
                    autocomplete="line" />
                <x-input-error for="line" class="mt-2" />
            </div>
        </x-slot>
    </x-add-textpractice>
    <x-add-picturepractice class="p-2 text-white rounded-md">
        <x-slot name="title">
            Picture Practice
        </x-slot>
        <x-slot name="form">
            <!-- Picture -->
            <div class="col-span-6 mt-2 sm:col-span-4">
                <x-label for="data" value="{{ __('Add Picture') }}" />

                <div
                    class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                    <x-input accept=" image/*" id="data" type="file"
                        class="absolute inset-0 z-50 w-full h-full p-0 m-0 bg-blue-400 outline-none opacity-0 cursor-pointer"
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
            <div class="col-span-6 mt-2 sm:col-span-4">
                <x-label for="line" value="{{ __('Line') }}" />
                <x-input id="line" type="number" class="block w-full mt-1" wire:model.defer="line" required
                    autocomplete="line" />
                <x-input-error for="line" class="mt-2" />
            </div>
        </x-slot>
    </x-add-picturepractice>
    <x-add-audiopractice class="p-2 text-white rounded-md">
        <x-slot name="title">
            Audio Practice
        </x-slot>
        <x-slot name="form">
            <!-- Picture -->
            <div class="col-span-6 mt-2 sm:col-span-4">
                <x-label for="data" value="{{ __('Add Audio/Record') }}" />
                <div
                    class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                    <x-input accept=" audio/*" id="data" type="file"
                        class="absolute inset-0 z-50 w-full h-full p-0 m-0 bg-blue-400 outline-none opacity-0 cursor-pointer"
                        wire:model.defer="data" required autocomplete="data" />
                    <div class="flex flex-col items-center justify-center py-10 text-center">
                        <svg fill="#adadad" class="w-10" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            stroke="#adadad">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M1,16V8A1,1,0,0,1,3,8v8a1,1,0,0,1-2,0Zm7,4V4A1,1,0,0,0,6,4V20a1,1,0,0,0,2,0Zm5,2V2a1,1,0,0,0-2,0V22a1,1,0,0,0,2,0Zm5-2V4a1,1,0,0,0-2,0V20a1,1,0,0,0,2,0ZM22,7a1,1,0,0,0-1,1v8a1,1,0,0,0,2,0V8A1,1,0,0,0,22,7Z">
                                </path>
                            </g>
                        </svg>
                        <p class="m-0">Drag your files here or click in this area.</p>
                    </div>
                </div>
                @if ($data && $type == 'audio')
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
                    <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                    </svg>
                </div>
                @endif
                <x-input-error for="data" class="mt-2" />
            </div>
            <!-- Line -->
            <div class="col-span-6 mt-2 sm:col-span-4">
                <x-label for="line" value="{{ __('Line') }}" />
                <x-input id="line" type="number" class="block w-full mt-1" wire:model.defer="line" required
                    autocomplete="line" />
                <x-input-error for="line" class="mt-2" />
            </div>
        </x-slot>
    </x-add-audiopractice>
    <livewire:admin.panswer />
</div>