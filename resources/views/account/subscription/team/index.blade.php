<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 w-full">
                    <form class="divide-y w-full" action="{{ route('account.subscription.team.update') }}" method="post">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="card-holder-name" :value="__('Team Name')" />
                            <x-text-input id="card-holder-name" class="block mt-1 w-full" type="text" name="name" autofocus :value="$team->name"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <button class="bg-green-200 px-4 py-2 hover:bg-green-500 rounded-md" type="submit" >Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class=" my-5">

        <div class="relative overflow-x-auto px-12">

            @if($team->users->count())
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Member Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Member Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Added
                    </th>
                    <th scope="col" class="px-6 py-3">
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($team->users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$user->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{$user->email}}
                    </td>
                    <td class="px-6 py-4">
                        {{$user->pivot->created_at->toDateString()}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('remove-{{$user->id}}').submit();">Delete</a>

                    </td>
                </tr>
                @endforeach




                </tbody>
            </table>
            @else
                <p>You've not added any team member</p>
            @endif

            @foreach($team->users as $user)
                    <form action="{{route('account.subscription.team.member.destroy',$user)}}" method="post" id="remove-{{$user->id}}" class="hidden">
                        @csrf
                        @method('delete')
                    </form>

                @endforeach

                <form class="divide-y w-full" action="{{ route('account.subscription.team.member.store') }}" method="post">
                    @csrf

                    <div>
                        <x-input-label for="card-holder-name" :value="__('Email')" />
                        <x-text-input id="card-holder-name" class="block mt-1 w-full" type="email" name="email" autofocus/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <button class="bg-green-200 px-4 py-2 hover:bg-green-500 rounded-md" type="submit" >Add</button>
                </form>
        </div>

    </div>
</x-app-layout>
