<div>
    <x-add-answer>
        <x-slot name="title">
            Add Answer
        </x-slot>
        <x-slot name="form">
            <!-- component -->
            <div class="flex flex-col w-full my-2">
                <div class="p-2 m-1 border border-gray-200 rounded-lg">
                    <div class="relative flex items-center h-10 p-1 mx-4 my-8 rounded-full">
                        <button wire:click="selectTypeAnswer(1)"
                            class=" items-center w-full flex justify-center @if($toggleTypeAnswer== 1) bg-indigo-600 text-white @else text-gray-600 @endif  border border-gray-300 mx-2 rounded-full  h-10 shadow">
                            <span>Type 1</span>
                        </button>
                        <button wire:click="selectTypeAnswer(2)"
                            class="@if($toggleTypeAnswer == 2) bg-indigo-600 text-white @else text-gray-600 @endif items-center w-full flex justify-center border border-gray-300 mx-2 rounded-full  shadow h-10 duration-150 ease-in-out">
                            <span>Type 2</span>
                        </button>
                        <button wire:click="selectTypeAnswer(3)"
                            class="@if($toggleTypeAnswer == 3) bg-indigo-600 text-white @else text-gray-600 @endif items-center w-full flex justify-center border border-gray-300 mx-2 rounded-full text-gray-600 shadow h-10 duration-150 ease-in-out">
                            <span>Type 3</span>
                        </button>
                        <button wire:click="selectTypeAnswer(4)"
                            class="@if($toggleTypeAnswer == 4) bg-indigo-600 text-white @else text-gray-600 @endif items-center w-full flex justify-center border border-gray-300 mx-2 rounded-full text-gray-600 shadow h-10 duration-150 ease-in-out">
                            <span>Type 4</span>
                        </button>
                    </div>
                </div>
                @if ($toggleTypeAnswer == 1)
                <div class="p-2 m-1 border border-gray-200 rounded-lg">
                    <div class="flex mb-4">
                        <div class="flex flex-col w-full flex-wrap overflow-x-scroll">
                            <?php for ($i=1; $i < 5; $i++) { ?>
                            <div class="  flex items-center p-2 m-2 bg-white border border-gray-200 rounded shadow">
                                <div class="mx-2">
                                    {{ $i }}.
                                </div>
                                <div class="flex items-center">
                                    @foreach( $this->loadAnswer($i) as $answer)
                                    @if ($answer->typeanswer == 'picture')
                                    <img class="w-10 h-10" src="{{ asset('storage/'.$answer->data) }}">
                                    @elseif($answer->typeanswer == 'text')
                                    {{ $answer->data }}
                                    @elseif($answer->typeanswer == 'audio')
                                    <audio controls class="mx-4 my-1">
                                        <source src="{{ asset('storage/'.$answer->data) }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                    @endif
                                    @endforeach
                                </div>
                                <button type="button" wire:click="choiceAnswer({{ $i }})"
                                    class="flex items-center w-8 h-8 px-2 bg-white border border-blue-400 rounded-md shadow">
                                    <img src="{{ asset('svg/plus.svg') }}" alt="Plus">
                                </button>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="flex flex-col w-full flex-wrap overflow-x-scroll">
                            <?php for ($i = 5; $i <= 8; $i++) { ?>
                            <div class="flex items-center p-2 m-2 bg-white border border-gray-200 rounded shadow">
                                <div class="mx-2">
                                    {{ $i }}.
                                </div>
                                <div class="flex items-center">
                                    @foreach( $this->loadAnswer($i) as $answer)
                                    @if ($answer->typeanswer == 'picture')
                                    <img class="w-10 h-10" src="{{ asset('storage/'.$answer->data) }}">
                                    @elseif($answer->typeanswer == 'text')
                                    {{ $answer->data }}
                                    @elseif($answer->typeanswer == 'audio')
                                    <audio controls class="mx-4 my-1">
                                        <source src="{{ asset('storage/'.$answer->data) }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                    @endif
                                    @endforeach
                                </div>
                                <button type="button" wire:click="choiceAnswer({{ $i }})"
                                    class="flex items-center w-8 h-8 px-2 bg-white border border-blue-400 rounded-md shadow">
                                    <img src="{{ asset('svg/plus.svg') }}" alt="Plus">
                                </button>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="flex justify-center my-2 text-lg">No. {{ $no }}</div>
                    <div class="relative flex items-center h-10 p-1 mx-4 mt-4 rounded-full">
                        <button wire:click="selectTypeData('text')"
                            class=" items-center w-full flex justify-center @if($toggleTypeData == 'text') bg-indigo-600 text-white @else text-gray-600 @endif  border border-gray-300 mx-2 rounded-full  h-10 shadow">
                            <span>Text</span>
                        </button>
                        <button wire:click="selectTypeData('picture')"
                            class="@if($toggleTypeData == 'picture') bg-indigo-600 text-white @else text-gray-600 @endif items-center w-full flex justify-center border border-gray-300 mx-2 rounded-full  shadow h-10 duration-150 ease-in-out">
                            <span>Picture</span>
                        </button>
                        <button wire:click="selectTypeData('audio')"
                            class="@if($toggleTypeAnswer == 'audio') bg-indigo-600 text-white @else text-gray-600 @endif items-center w-full flex justify-center border border-gray-300 mx-2 rounded-full text-gray-600 shadow h-10 duration-150 ease-in-out">
                            <span>Audio</span>
                        </button>
                    </div>

                    @if ($toggleTypeData == 'text')
                    <x-input id="data" type="text" class="block w-full p-2 mx-2 mt-4" wire:model="data" required
                        placeholder="Insert Text Answer" autocomplete="data" />
                    <x-input-error for="data" class="mt-2" />
                    <button class="w-full p-2 mt-4 text-white bg-blue-600 rounded" wire:click="save()">Add</button>
                    @elseif($toggleTypeData == 'picture')
                    <div class="col-span-6 mt-2 sm:col-span-4">
                        <div
                            class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                            <x-input accept="image/*" id="pict" type="file"
                                class="absolute inset-0 z-50 w-full h-full p-0 m-0 bg-blue-400 outline-none opacity-0 cursor-pointer"
                                wire:model="pict" required autocomplete="pict" />
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
                            @if ($pict != null && $toggleTypeData == 'picture')
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
                                    src="{{ $pict->temporaryUrl() }}" />
                            </div>
                            <x-input-error for="pict" class="mt-2" />
                            @endif
                        </div>
                    </div>
                    <button class="w-full p-2 mt-4 text-white bg-blue-600 rounded" wire:click="save()">Add</button>
                    @elseif($toggleTypeData == 'audio')
                    <div class="col-span-6 mt-2 sm:col-span-4">
                        <div
                            class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                            <x-input accept="audio/*" id="audio" type="file"
                                class="absolute inset-0 z-50 w-full h-full p-0 m-0 bg-blue-400 outline-none opacity-0 cursor-pointer"
                                wire:model.defer="audio" required autocomplete="audio" />
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
                        @if ($audio != null && $toggleTypeData == 'audio')
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
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                        @endif
                        <x-input-error for="audio" class="mt-2" />
                    </div>
                    <button class="w-full p-2 mt-4 text-white bg-blue-600 rounded" wire:click="save()">Add</button>
                    @endif
                </div>
                <div class="p-2 m-1 border border-gray-200 rounded-lg">
                    <div class="w-full">
                        {{-- Title --}}
                        <div class="flex justify-center text-xl">ANSWER</div>
                        <div class="flex items-center justify-center my-2 ">
                            <div
                                class="flex items-center justify-center w-10 h-10 text-lg border border-gray-300 rounded">
                                1</div>
                            <div class="text-lg"> -> </div>
                            <input type="number" min="5" max="8" wire:model="satu"
                                class="flex items-center justify-center h-10 text-lg border border-gray-300 rounded w-15" />
                        </div>
                        <div class="flex items-center justify-center my-2 ">
                            <div
                                class="flex items-center justify-center w-10 h-10 text-lg border border-gray-300 rounded">
                                2</div>
                            <div class="text-lg"> -> </div>
                            <input type="number" min="5" max="8" wire:model="dua"
                                class="flex items-center justify-center h-10 text-lg border border-gray-300 rounded w-15" />
                        </div>
                        <div class="flex items-center justify-center my-2 ">
                            <div
                                class="flex items-center justify-center w-10 h-10 text-lg border border-gray-300 rounded">
                                3</div>
                            <div class="text-lg"> -> </div>
                            <input type="number" min="5" max="8" wire:model="tiga"
                                class="flex items-center justify-center h-10 text-lg border border-gray-300 rounded w-15" />
                        </div>
                        <div class="flex items-center justify-center my-2 ">
                            <div
                                class="flex items-center justify-center w-10 h-10 text-lg border border-gray-300 rounded">
                                4</div>
                            <div class="text-lg"> -> </div>
                            <input type="number" min="5" max="8" wire:model="empat"
                                class="flex items-center justify-center h-10 text-lg border border-gray-300 rounded w-15" />
                        </div>
                        <button class="w-full p-2 mt-4 text-white bg-blue-600 rounded"
                            wire:click="saveAnswer">Save</button>
                        @if (session()->has('answer'))
                        <div class="px-4 py-2 my-4 text-green-900 bg-green-400 rounded-lg">
                            {{ session('answer') }}
                        </div>
                        @endif
                    </div>
                </div>
                @elseif($toggleTypeAnswer == 2)
                <div class="p-2 m-1 border border-gray-200 rounded-lg">
                    <div class="flex flex-wrap">
                        @foreach( $this->loadAnswer() as $answer)
                        <div class="w-auto px-4 py-2 m-2 text-lg border border-gray-200 rounded-lg">
                            <span class="mx-2 text-gray-200">{{ $answer->nomor }}</span> {{ $answer->data}}
                        </div>
                        @endforeach
                    </div>
                    <x-input id="data" type="text" class="block w-full p-2 mt-4" wire:model="data" required
                        placeholder="Insert Text" autocomplete="data" />
                    <x-input-error for="data" class="mt-2" />
                    <button class="w-full p-2 mt-4 text-white bg-blue-600 rounded" wire:click="save">Save</button>
                </div>
                @elseif($toggleTypeAnswer == 3)
                <div class="p-2 m-1 border border-gray-200 rounded-lg">
                    <div class="flex flex-wrap">
                        @foreach( $this->loadAnswer() as $answer)
                        <div class="w-auto px-4 py-2 m-2 text-lg border border-gray-200 rounded-lg">
                            <span class="mx-2 text-gray-200">{{ $answer->nomor }}</span> {{ $answer->data}}
                        </div>
                        @endforeach
                    </div>
                    <x-input id="data" type="text" class="block w-full p-2 mt-4" wire:model="data" required
                        placeholder="Insert Text" autocomplete="data" />
                    <x-input-error for="data" class="mt-2" />
                    <button class="w-full p-2 mt-4 text-white bg-blue-600 rounded" wire:click="save">Save</button>
                </div>
                <div class="p-2 m-1 border border-gray-200 rounded-lg ">
                    <div class="flex justify-center text-xl">ANSWER</div>
                    <div class="flex justify-center">
                        <input type="number" min="1" max="{{$this->loadAnswer()->count() }}" wire:model="satu"
                            class="flex items-center justify-center h-10 my-4 text-lg border border-gray-300 rounded w-15" />
                    </div>
                    <button class="w-full p-2 mt-4 text-white bg-blue-600 rounded"
                        wire:click="saveAnswer()">Save</button>
                    @if (session()->has('answer'))
                    <div class="px-4 py-2 my-4 text-green-900 bg-green-400 rounded-lg">
                        {{ session('answer') }}
                    </div>
                    @endif
                </div>
                @elseif($toggleTypeAnswer == 4)
                <div class="p-2 m-1 border border-gray-200 rounded-lg">
                    <div class="flex justify-center text-xl">ANSWER</div>

                    <div class="flex flex-wrap">
                        @foreach( $this->loadAnswer() as $answer)
                        <div class="w-auto px-4 py-2 m-2 text-lg border border-gray-200 rounded-lg">
                            <span class="mx-2 text-gray-200">{{ $answer->nomor }}</span> {{ $answer->data}}
                        </div>
                        @endforeach
                    </div>
                    @if($this->maxAnswer()->count()
                    <1) <x-input id="data" type="text" class="block w-full p-2 mt-4 uppercase" wire:model="data"
                        required placeholder="Insert Text" autocomplete="data" />
                    <x-input-error for="data" class="mt-2" />
                    <button class="w-full p-2 mt-4 text-white bg-blue-600 rounded"
                        wire:click="saveAnswer()">Save</button>
                    @endif

                    @if (session()->has('answer'))
                    <div class="px-4 py-2 my-4 text-green-900 bg-green-400 rounded-lg">
                        {{ session('answer') }}
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </x-slot>
    </x-add-answer>
</div>