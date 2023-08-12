<div>
    @push('pageTitle', $materi->title. " - Lesson - ")
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
            <a href="{{ url()->previous() }}">{{ $materi->topic->name }}</a>
            <div class="mx-2"> > </div>
            {{ $materi->title }}
        </div>
    </x-slot>
    {{-- Content --}}
    <div class="fixed w-full overflow-y-scroll top-14 bottom-20 mt-2 mb-5 scrollbar-thumb-cyan-950 scrollbar-thin">
        <div class="flex flex-col justify-center items-center">
            @foreach ($materi->lessons as $lesson)
            <div class="w-10/12">
                <img src="{{ asset('storage/'.$lesson->picture) }}">
            </div>
            @endforeach
        </div>
    </div>
    <div class="fixed bottom-0 w-full z-10">
        <div class="bg-white w-full flex justify-center flex-col items-center">
            <hr class="h-1 rounded-full bg-blue-300 w-10/12 mb-1" />
            <div class="flex justify-between items-center text-xl w-10/12 mb-3 pb-6">
                <div class="text-lg uppercase mt-4 border-2 py-1 px-6 rounded-full border-blue-500">Lesson</div>
                <div>
                    <a href="{{ route('user.practices', $materi->slug) }}"
                        class="px-8 py-2 mt-2 bg-blue-400 rounded-lg text-white shadow hover:bg-blue-500 ease-in-out duration-150">Next
                        to Practice</a>
                    <a href="{{ route('user.tests', $materi->slug) }}"
                        class="px-8 py-2 mt-2 bg-blue-400 rounded-lg text-white shadow hover:bg-blue-500 ease-in-out duration-150">Go
                        to Test</a>
                </div>
            </div>
        </div>
    </div>
</div>