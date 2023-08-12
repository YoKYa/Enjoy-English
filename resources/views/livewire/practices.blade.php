<div>
    @push('pageTitle', $materi->title. " - Practice - ")
    <x-slot name="header">
        <a href="{{ url()->previous() }}" class="mx-4">
            <div class="h-10 w-10 hover:bg-gray-200 rounded-full p-1">
                <svg fill="#000000" viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title></title>
                        <path
                            d="M160,89.75H56l53-53a9.67,9.67,0,0,0,0-14,9.67,9.67,0,0,0-14,0l-56,56a30.18,30.18,0,0,0-8.5,18.5c0,1-.5,1.5-.5,2.5a6.34,6.34,0,0,0,.5,3,31.47,31.47,0,0,0,8.5,18.5l56,56a9.9,9.9,0,0,0,14-14l-52.5-53.5H160a10,10,0,0,0,0-20Z">
                        </path>
                    </g>
                </svg>
            </div>

        </a>
        <div class=" w-10">
            <img src="{{ asset('svg/menu.svg') }}">
        </div>
        <div class="flex mx-4 justify-center">
            <a href="{{ route('topics') }}">TOPICS</a>
            <div class="mx-2"> > </div>
            <a href="{{ route('materi', $materi->id) }}">{{ $materi->topic->name }}</a>
            <div class="mx-2"> > </div>
            {{ $materi->title }}
        </div>
    </x-slot>
    {{-- Content --}}
    <div class="fixed w-full overflow-y-scroll top-14 bottom-20 mt-1 mb-5 scrollbar-thumb-cyan-950 scrollbar-thin">
        <div class="flex flex-col justify-center items-center">
            <div class="w-10/12 flex flex-col p-5">
                @if ($end == true)
                {{-- End Practice --}}
                <div class="flex flex-col justify-center items-center h-96">
                    <div><img src="{{ asset('svg/pid.svg') }}"></div>
                </div><br />
                @else
                <?php 
                    for($i = 1; $i <= $maxLine; $i++) {
                ?>
                {{-- Question --}}
                <div class="flex flex-col my-1">
                    <div class="flex flex-wrap items-center">
                        @foreach ($this->getQuestionLine($i) as $question)
                        <div class="text-xl mx-1 ">
                            @if ($question->type == 'text')
                            {{ $question->data }}
                            @elseif($question->type == 'picture')
                            <img src="{{ asset('storage/'.$question->data) }}" width="400">
                            @elseif($question->type == 'audio')
                            <audio controls class="mx-4 my-1">
                                <source src="{{ asset('storage/'.$question->data) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            @endif
                        </div>
                        @endforeach
                    </div>

                </div>
                <?php } ?>
                {{-- Answer --}}
                @if ($practice->type == 'speaking')
                <div class="h-40 bg-white rounded-lg mt-5">
                    <div
                        class="my-2 h-20 text-2xl overflow-hidden border-gray-200 border rounded-lg flex flex-col  items-center">
                        <p id="result" class=""></p>
                    </div>

                    <button id="start"
                        class="bg-blue-400 hover:bg-blue-500 text-white w-full py-3 rounded-lg @if ($listening == true) hidden @endif"
                        wire:click="startListening">Start
                        Listening</button>
                    <button id="stop"
                        class="bg-red-400 hover:bg-red-500 text-white w-full py-3 rounded-lg @if ($listening == false) hidden @endif"
                        wire:click="stopListening">Stop
                        Listening</button>
                </div>
                @else
                {{-- Check Type Answer --}}
                @if ($this->checkTypeAnswer() == 1)
                <div class="mt-8 flex">
                    <div class="flex flex-col w-1/2">
                        <?php for ($i=0; $i < 4; $i++) { ?>
                        <button wire:click='choiceAnswer({{ $i+1 }})'
                            class="flex flex-wrap items-center border-2 border-gray-300 rounded-lg m-2 p-2 shadow-lg @if($i+1 == $a) bg-blue-500 text-white @endif">
                            <div
                                class=" text-lg mx-4 border-gray-300 border rounded-lg w-10 h-10 flex justify-center items-center bg-white text-gray-400 ">
                                {{ $i+1 }}
                            </div>

                            @foreach ($this->getAnswer($i+1) as $answer)
                            @if ($answer->typeanswer == 'text')
                            {{ $answer->data }}
                            @elseif( $answer->typeanswer == 'picture' )
                            <img src="{{ asset('storage/'.$answer->data)}}" width="250">
                            @elseif( $answer->typeanswer == 'audio' )
                            <audio controls class="mx-4 my-1">
                                <source src="{{ asset('storage/'.$answer->data) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            @endif
                            @endforeach
                        </button>
                        <?php } ?>
                    </div>
                    <div class="flex flex-col w-1/2">
                        <?php for ($i=4; $i < 8; $i++) { ?>
                        <button wire:click='choiceAnswer({{ $i+1 }})'
                            class="flex flex-wrap items-center border-2 border-gray-300 rounded-lg m-2 p-2 shadow-lg  @if($i+1 == $b) bg-blue-500 text-white  @endif">
                            <div
                                class=" text-lg mx-1 border-gray-300 border rounded-lg w-10 h-10 flex justify-center items-center bg-white text-gray-400 ">
                                {{ $i+1 }}
                            </div>
                            <div
                                class=" text-lg mx-1 mr-4 border-gray-300 border rounded-lg w-10 h-10 flex justify-center items-center bg-white text-gray-400 ">
                                {{ $answerType[$i-4] }}
                            </div>
                            @foreach ($this->getAnswer($i+1) as $answer)
                            @if ($answer->typeanswer == 'text')
                            {{ $answer->data }}
                            @elseif( $answer->typeanswer == 'picture' )
                            <img src="{{ asset('storage/'.$answer->data)}}" width="250">
                            @elseif( $answer->typeanswer == 'audio' )
                            <audio controls class="mx-4 my-1">
                                <source src="{{ asset('storage/'.$answer->data) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            @endif
                            @endforeach
                        </button>
                        <?php } ?>
                    </div>
                </div>
                @elseif($this->checkTypeAnswer() == 2)
                <div class="flex flex-col mt-8">
                    <div class="flex my-2 p-2 h-20">
                        <?php for ($i=0; $i < count($answerType2) ; $i++) { ?>
                        <div wire:click='deleteChoiceAnswer( {{ $i }})' class="flex flex-wrap">
                            <button class=" py-2 px-4 m-1 border border-gray-300 shadow-lg rounded-full">
                                {{ $answerType2[$i]["data"] }}
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="w-full h-1 rounded-full bg-slate-300"></div>
                    <div class="flex my-2 p-2 h-20">
                        <?php for ($i=0; $i < count($randomAnswers) ; $i++) { ?>
                        <div class="flex flex-wrap">
                            <button wire:click='choiceAnswer2({{ $i }})'
                                class="py-2 px-4 m-1 border border-gray-300 shadow-lg rounded-full">
                                {{ $randomAnswers[$i]["data"] }}
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="w-full h-1 rounded-full bg-slate-300"></div>
                </div>
                @elseif($this->checkTypeAnswer() == 3)
                <div class="flex flex-col mt-8">
                    <div class="flex my-2 p-2 h-20">
                        <?php for ($i=0; $i < 1 ; $i++) { ?>
                        @isset($answerType2[$i])
                        <div wire:click='deleteChoiceAnswer( {{ $i }})' class="flex flex-wrap">
                            <button class=" py-2 px-4 m-1 border border-gray-300 shadow-lg rounded-full">
                                {{ $answerType2[$i]["data"] }}
                            </button>
                        </div>
                        @endisset
                        <?php } ?>
                    </div>
                    <div class="w-full h-1 rounded-full bg-slate-300"></div>
                    <div class="flex my-2 p-2 h-20">
                        <?php for ($i=0; $i < count($randomAnswers) ; $i++) { ?>
                        <div class="flex flex-wrap">
                            <button wire:click='choiceAnswer2({{ $i }})'
                                class="py-2 px-4 m-1 border border-gray-300 shadow-lg rounded-full">
                                {{ $randomAnswers[$i]["data"] }}
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="w-full h-1 rounded-full bg-slate-300"></div>
                </div>
                @elseif($this->checkTypeAnswer() == 4)
                <x-input id="answer" type="text" class="mt-8 p-2 block w-full " wire:model.defer="writeAnswer" required
                    placeholder="Write the Answer" />
                @endif
                @endif
                @endif
            </div>
        </div>
    </div>
    {{-- Footer --}}
    <div class="fixed bottom-0 w-full z-10">
        <div class="bg-white w-full flex justify-center flex-col items-center">
            <hr class="h-1 rounded-full bg-blue-300 w-10/12 mb-1" />
            <div class="flex justify-between items-center text-xl w-10/12 mb-3 pb-6">
                <div class="flex">
                    <div class="text-lg uppercase mt-4 border-2 py-1 px-6 rounded-full border-blue-500 mx-1">Practice
                    </div>
                    <div class="text-lg uppercase mt-4 border-2 py-1 px-6 rounded-full border-blue-500 mx-1"> {{ $no+1
                        }}/{{
                        count($practices) }}
                    </div>
                </div>

                <div class="flex mt-4">
                    @if ($practice->type == 'grammar' && $end == false )
                    <button wire:click="checkAnswer"
                        class="mx-1 bg-blue-500 px-4 py-2 rounded-full text-white hover:bg-blue-600">Check</button>
                    <button wire:click="next"
                        class="mx-1 bg-blue-500 px-4 py-2 rounded-full text-white hover:bg-blue-600">Next</button>
                    @elseif($end == true)
                    <a href="{{ route('materi', $materi->id) }}"
                        class="mx-1 bg-blue-500 px-4 py-2 rounded-full text-white hover:bg-blue-600 shadow-lg">Back to
                        Materi</a>
                    <a href="{{ route('user.tests', $materi->slug) }}"
                        class="mx-1 bg-blue-500 px-4 py-2 rounded-full text-white hover:bg-blue-600 shadow-lg">Next To
                        Test</a>
                    @elseif($practice->type == 'speaking' && $end == false)
                    <button wire:click="next"
                        class="mx-1 bg-blue-500 px-4 py-2 rounded-full text-white hover:bg-blue-600">Next</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <x-check-practice class="p-2 text-white rounded-md">
        <x-slot name="name">
            Check
        </x-slot>
        <x-slot name="form">
            @if($this->checkTypeAnswer() == 1)
            <div class="flex flex-col">
                <?php for($i = 0; $i < 4; $i++) { ?>
                <div class="flex">
                    <div class="m-1 w-10 h-10 p-2 border rounded-lg border-gray-300 flex justify-center items-center">{{
                        $i+5 }}
                    </div>
                    <div class="m-1 w-10 h-10 p-2 border rounded-lg border-gray-300 flex justify-center items-center">{{
                        $answerType[$i] }}</div>
                    @if ($jawaban[$i])
                    <div class="w-8 h-8 m-1">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <circle opacity="0.5" cx="12" cy="12" r="10" stroke="#00a822" stroke-width="1.5">
                                </circle>
                                <path d="M8.5 12.5L10.5 14.5L15.5 9.5" stroke="#00a822" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </div>
                    @else
                    <div class="w-8 h-8 m-1">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <circle opacity="0.5" cx="12" cy="12" r="10" stroke="#f52424" stroke-width="1.5">
                                </circle>
                                <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="#f52424"
                                    stroke-width="1.5" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </div>
                    @endif
                </div>
                <?php } ?>
            </div>
            @elseif($this->checkTypeAnswer() == 2)
            <div>Your Answer : </div>
            <div class="flex text-lg">
                @foreach ($answerType2 as $answer)
                {{ $answer['data'] }}
                @endforeach
            </div>
            <div>Right Answer : </div>
            <div class="flex text-lg">
                @foreach ($answers as $answer)
                {{ $answer->data }}
                @endforeach
            </div>
            @elseif($this->checkTypeAnswer() == 3)
            <div>Your Answer : </div>
            <div class="flex text-lg">{{ $answerType2[0]["data"]?? null }}</div>
            <div>Right Answer : </div>
            <div class="flex text-lg">
                {{$this->getAnswer($this->getAnswer(1)[0]->answer)[0]->data ?? null}}
            </div>
            @elseif($this->checkTypeAnswer() == 4)
            <div>Your Answer : </div>
            <div class="flex text-lg">{{ $writeAnswer }}</div>
            <div>Right Answer : </div>
            <div class="flex text-lg">
                {{ $this->getAnswer(1)[0]->answer }}
            </div>
            @endif

        </x-slot>
    </x-check-practice>
    {{-- Script --}}
    <script>
        document.addEventListener('livewire:load', function () {
               if (!"webkitSpeechRecognition" in window) {
            alert("Update Browser");
            }
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            let recognition = new SpeechRecognition();
            
            recognition.lang = 'en-US';
            recognition.continuous = true;
            recognition.interimResults = false;
            document.querySelector("#start").onclick = () => {
            recognition.start();
            }
            document.querySelector("#stop").onclick = () => {
            recognition.stop();
            }
            
            recognition.onresult = function (event) {
            let textResult = "";
            textResult = event.results[event.results.length - 1][0].transcript;
            document.querySelector("#result").insertAdjacentHTML("afterend", `<p class="my-6">${textResult}</p>`);
            console.log(textResult);
            };
            })
    </script>

</div>