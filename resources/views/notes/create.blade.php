<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="btn-link btn-lg mb-2">Add Your New Note</h2>

                  
                    <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                        <!-- @foreach($errors->all() as $error)
                            <p class="red">{{ $error }}</p>
                        @endforeach -->

                        <form action="{{ route('notes.store') }}" method="post">
                            @csrf
                            <input
                                type="text"
                                name="title"
                                field="title"
                                placeholder="Title"
                                class="w-full"
                                autocomplete="off" 
                                :value="@old('title')">

                            @error('title')
                               <div class="text-red-600 text-sm"> {{ $message }} </div>
                            @enderror

                            <textarea
                                name="text"
                                rows="10"
                                field="text"
                                placeholder="Start typing here..."
                                class="w-full mt-6"
                                :value="@old('text')"></textarea>
                                @error('text')
                                    <div class="text-red-600 text-sm"> {{ $message }} </div>
                                @enderror
                            <button class="mt-6">Save Note</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
