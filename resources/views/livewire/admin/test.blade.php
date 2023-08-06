<div>
    {{ Breadcrumbs::render('admin.test', $materi->slug) }}
    @push('pageTitle', "Admin - Test - ")
    <!-- component -->
    @if (session()->has('success'))
    <div class="px-4 py-2 my-4 mx-4 text-green-900 bg-green-400 rounded-lg">
        {{ session('success') }}
    </div>
    @endif
    <section class="container px-4 mx-auto">
        <div class="flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center">
                                            <div class="flex items-center">
                                                <span>No.</span>
                                            </div>
                                        </div>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Question
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Status
                                    </th>
                                    <th scope="col" class="relative py-3.5 px-4">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                @php $i = 1 @endphp
                                @foreach ($materi->tests as $tests)
                                <tr>
                                    <td
                                        class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                        <div class="inline-flex items-center">
                                            <span>{{ $i++ }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 flex">
                                        <div class="flex">
                                            @foreach ($tests->question as $t)
                                            @if ($t->type == "picture")
                                            [Picture]
                                            @elseif($t->type == "audio")
                                            [Audio]
                                            @else
                                            {{ $t->data }}
                                            @endif
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        @if ($this->status($tests->id))<div
                                            class="inline-flex items-center px-3 py-1 rounded-full text-emerald-500 bg-emerald-100/60 dark:bg-gray-800">


                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>


                                        </div>
                                        @else
                                        <div
                                            class="inline-flex items-center px-3 py-1 text-red-500 rounded-full bg-red-100/60 dark:bg-gray-800">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 3L3 9M3 3L9 9" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="flex items-center">
                                            <button wire:click="$emit('modal', {{ $tests->id }})"
                                                class="mx-1 p-1 px-2 hover:text-white hover:bg-blue-500  rounded-full border border-blue-500 text-blue-500 transition-colors duration-200  focus:outline-none">
                                                Add Question
                                            </button>
                                            <button wire:click="$emit('modalA', {{ $tests->id }})"
                                                class="mx-1 p-1 px-2 hover:text-white hover:bg-blue-500 rounded-full border border-blue-500 text-blue-500 transition-colors duration-200  focus:outline-none">
                                                Add Answer
                                            </button>
                                            <button wire:click="deleteNumber({{ $tests->id }})"
                                                class="mx-1 p-1 px-2 border rounded-full border-red-500 text-red-500 transition-colors duration-200 hover:text-white hover:bg-red-500 focus:outline-none">
                                                Delete
                                            </button>
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
    </section>
    <div class="w-full">
        <button wire:click="addNumber" class="px-4 py-2 mx-4 my-2 text-white bg-blue-600 rounded-md shadow">Add
            Number</button>
    </div>
    <livewire:admin.question />
    <livewire:admin.answer />
</div>