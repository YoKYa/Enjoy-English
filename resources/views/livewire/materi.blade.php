<div>
    {{ Breadcrumbs::render('materi', $topic->id) }}
    @push('pageTitle', $topic->name ." - ")
    <div class="flex justify-between items-center">
        <div class="text-xl uppercase">{{$topic->name }}</div>
    </div>

    @if (session()->has('message'))
    <div class="text-green-900 bg-green-400 px-4 py-2 my-4 rounded-lg">
        {{ session('message') }}
    </div>
    @endif
    <div class=" border-gray-500 shadow rounded-lg h-auto p-8 grid grid-cols-2 gap-4">
        @php $no = 0 @endphp
        @foreach ($materis as $materi)
        <div
            class="mt-8 relative hover:bg-gray-100 border border-gray-200 duration-150 ease-in-out hover:scale-105 flex w-full flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div
                class="relative mx-4 -mt-6 h-40 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40 bg-gradient-to-r from-biru-2 to-biru-3">
                <div class="mt-4 mb-1 mx-4 flex justify-between">
                    <div class="uppercase">Materi {{++$no }}</div>
                    <div>High Score : 100</div>
                </div>
                <h5
                    class="mt-8 mx-4 mb-2 block font-sans text-2xl leading-snug tracking-normal text-blue-gray-900 antialiased">
                    {{ $materi->title }}
                </h5>
            </div>
            <div class="p-6">
                <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                    {{ $materi->description }}
                </p>
            </div>
            <div class="p-6 pt-0">
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
</div>