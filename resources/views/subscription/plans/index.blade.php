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
                    <ul class="divide-y w-full">
                        @foreach($plans as $plan)
                            <li class="px-2 py-4 border"><a href="{{route('subscription.index')}}?plan={{$plan->slug}}" class="">{{$plan->name}} (${{$plan->price}})</a></li>
                        @endforeach

                        <li class="px-2 py-4 border"><a href="{{route('plans.teams.index')}}" class="">Team Plans</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


