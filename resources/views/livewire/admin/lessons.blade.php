<div>
    {{ Breadcrumbs::render('admin.lessons', $materi->slug) }}
    @push('pageTitle', "Admin - Lessons - ")
    <div>
        <div class="w-full mx-auto bg-white rounded p7">
            <div class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                @foreach ($lessons as $lesson)
                <div
                    class="relative flex flex-col items-center w-full h-auto mt-4 overflow-hidden text-center bg-gray-100 border rounded select-none">
                    <button wire:click="deletePicture({{ $lesson->id }})"
                        class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none" type="button">
                        <svg class="w-8 h-8 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    <img src="{{ asset('storage/'.$lesson->picture) }}">
                </div>

                @endforeach
            </div>
        </div>
        <div class="w-full mx-auto my-2 bg-white rounded p7">
            <div class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                <div
                    class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                    <input accept="image/*" type="file"
                        class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                        wire:model='file' />
                    <div class="flex flex-col items-center justify-center py-10 text-center">
                        <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="m-0">Drag your files here or click in this area.</p>
                    </div>
                </div>
                @if ($file)
                <div
                    class="relative flex flex-col items-center w-full h-64 mt-4 overflow-hidden text-center bg-gray-100 border rounded select-none">
                    <button wire:click="deleteFile"
                        class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none" type="button">
                        <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    <img class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                        src="{{ $file->temporaryUrl() }}" />
                </div>
                @error('file') <span class="m-2 text-red-600">{{ $message }}</span> @enderror

                <button wire:click='saveFile' @error('file') hidden @enderror
                    class="p-2 my-2 text-white bg-blue-400 rounded-md hover:bg-blue-600">Save</button>
                <div wire:loading wire:target="file">Uploading...</div>
                @endif
            </div>
        </div>
    </div>
</div>