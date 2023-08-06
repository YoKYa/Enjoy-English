<div>
    <x-add-Question>
        <x-slot name="title">
            Question
        </x-slot>
        <x-slot name="form">
            <div class="border border-gray-200 rounded-lg p-2">
                <div class="flex flex-col">
                    <div class="flex w-full">
                        <div class="w-1/12 uppercase flex justify-center items-center">line</div>
                        <div class="w-11/12 uppercase flex justify-center items-center">content</div>
                    </div>
                    @php $l = 1; @endphp
                    <?php while ($l <= $selectedLine) { ?>
                    <hr>
                    <div class="flex w-full">
                        <div class="w-1/12 flex justify-center items-center">{{ $l }}</div>
                        <div class="w-11/12 uppercase flex justify-start items-center overflow-x-scroll">
                            @foreach ($this->getQuestion($l) as $question)
                            @if ($question->type == "text")
                            <div class="my-2 mx-1">{{ $question->data }}</div>
                            @elseif($question->type == "picture")
                            <img class="m-2 w-52" src="{{ asset('storage/'.$question->data) }}">
                            @elseif($question->type == "audio")
                            <audio controls class="m-2">
                                <source src="{{ asset('storage/'.$question->data) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <?php $l++; } ?>
                </div>
            </div>
            <div class="border border-gray-200 rounded-lg p-2 mt-4">
                @if (session()->has('success'))
                <div class="px-4 py-2 my-4 mx-4 text-green-900 bg-green-400 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif
                <div class="relative flex items-center h-10 p-1 mx-4 mt-4 rounded-full">
                    <button wire:click="selectTypeQuestion('text')"
                        class=" items-center w-full flex justify-center @if($toggleType == 'text') bg-indigo-600 text-white @else text-gray-600 @endif  border border-gray-300 mx-2 rounded-full  h-10 shadow">
                        <span>Text</span>

                    </button>
                    <button wire:click="selectTypeQuestion('picture')"
                        class="@if($toggleType == 'picture') bg-indigo-600 text-white @else text-gray-600 @endif items-center w-full flex justify-center border border-gray-300 mx-2 rounded-full  shadow h-10 duration-150 ease-in-out">
                        <span>Picture</span>
                    </button>
                    <button wire:click="selectTypeQuestion('audio')"
                        class="@if($toggleType == 'audio') bg-indigo-600 text-white @else text-gray-600 @endif items-center w-full flex justify-center border border-gray-300 mx-2 rounded-full text-gray-600 shadow h-10 duration-150 ease-in-out">
                        <span>Audio</span>
                    </button>
                </div>
                @if ($toggleType == 'text')
                <x-input id="data" type="text" class="block w-full p-2  mt-4" wire:model="data" required
                    placeholder="Insert Text Answer" autocomplete="data" />
                <x-input-error for="data" class="mt-2" />
                @elseif($toggleType == 'picture')
                <div class="col-span-6 mt-2 sm:col-span-4">
                    <div
                        class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                        <x-input accept="image/*" id="pict" type="file"
                            class="absolute inset-0 z-50 w-full h-full p-0 m-0 bg-blue-400 outline-none opacity-0 cursor-pointer"
                            wire:model="data" required autocomplete="data" />
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="m-0">Drag your files here or click in this area.</p>
                        </div>
                    </div>
                    <div>
                        @if ($data != null && $toggleType == 'picture')
                        <div
                            class="relative flex flex-col items-center w-32 h-32 mt-4 overflow-hidden text-center bg-gray-100 border rounded select-none">
                            <button wire:click="delete"
                                class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none"
                                type="button">
                                <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                            <img class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                                src="{{ $data->temporaryUrl() }}" />
                        </div>
                        <x-input-error for="data" class="mt-2" />
                        @endif
                    </div>
                </div>
                @elseif($toggleType == 'audio')
                <div class="col-span-6 mt-2 sm:col-span-4">
                    <div
                        class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                        <x-input accept="audio/*" id="data" type="file"
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
                    @if ($data != null && $toggleType == 'audio')
                    <div
                        class="relative flex flex-col items-center w-full h-64 mt-4 overflow-hidden text-center bg-gray-100 border rounded select-none">
                        <button wire:click="delete"
                            class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none"
                            type="button">
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
                @endif
                <div class="col-span-6 mt-2 sm:col-span-4">
                    <x-label for="line" class="w-full p-2 mx-2" value="{{ __('LINE') }}" />
                    <x-input id="line" min="1" type="number" class="block w-full p-2" wire:model.defer="line" required
                        autocomplete="line" />
                    <x-input-error for="line" class="mt-2" />
                </div>
                <button class="w-full p-2 mt-4 text-white bg-blue-600 rounded" wire:click="saveQuestion()">Add</button>
            </div>
        </x-slot>
    </x-add-question>
</div>