<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-2 px-6 py-2 bg-gray-800">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
                        <a class="btn-link" href="{{ route('notes.edit', $note) }}">Edit</a>
                        <form action="{{ route('notes.destroy', $note) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this note?')">Delete</button>
                        </form>
                    </div>
                    <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                        <h2 class="font-bold text-2xl">
                            {{ $note->title }}
                        </h2>
                        <p class="mt-2">{{ $note->text }}</p>
                        

                    </div>
                 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
