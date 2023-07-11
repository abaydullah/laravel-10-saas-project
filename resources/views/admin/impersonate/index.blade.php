<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 w-full">
                    <form class="divide-y w-full" action="{{ route('admin.impersonate.store') }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <x-input-label for="card-holder-name" :value="__('User Email')" />
                            <x-text-input id="card-holder-name" class="block mt-1 w-full" type="email" name="email" autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <button class="bg-green-300 px-4 py-2 hover:bg-green-500 rounded-md" type="submit" id="card-button">Impersonate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
