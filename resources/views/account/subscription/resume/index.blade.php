<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resume') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 w-full">
                    <form class="divide-y w-full" action="{{ route('account.subscription.resume.store') }}" method="post">
                        @csrf
                        <span class="text-sm mb-5">You Are Sure You Want Resume ?</span><br>
                        <button class="bg-green-200 px-4 py-2 hover:bg-green-500 rounded-md" type="submit">Resume</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
