<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                        <form action="{{ route('notes.update', $note) }}" method="post">
                            @method('put')
                            @csrf
                            <input
                                type="text"
                                name="title"
                                field="title"
                                placeholder="Title"
                                class="w-full"
                                autocomplete="off" 
                                value="{{ $note->title }}">

                            @error('title')
                               <div class="text-red-600 text-sm"> {{ $message }} </div>
                            @enderror

                            <textarea
                                name="text"
                                rows="10"
                                field="text"
                                placeholder="Start typing here..."
                                class="w-full mt-6"
                                value="@old('text', $note->text)">{{ $note->text }}</textarea>
                             
                                @error('text')
                                    <div class="text-red-600 text-sm"> {{ $message }} </div>
                                @enderror
                         
                                <button class="mt-6">Update Note</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
