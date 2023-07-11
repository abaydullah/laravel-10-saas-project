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
                    <p>Current Plan: {{auth()->user()->plan->name}} (${{auth()->user()->plan->price}})</p>
                    <form class="divide-y w-full mt-5" action="{{ route('account.subscription.swap.store') }}" method="post">
                        @csrf
                        <div>
                            <x-input-label for="email" :value="__('Plans')" />
                            <select name="plan" id="plan" class="block mt-1 w-full">
                                @foreach($plans as $plan)

                                    <option value="{{$plan->gateway_id}}">{{$plan->name}}</option>
                                @endforeach

                            </select>
                            <x-input-error :messages="$errors->get('plan')" class="mt-2" />
                        </div>
                        <div>
                            <label for="">Card details</label>
                            <div id="card-element"></div>
                        </div>
                        <button class="bg-green-200 px-4 py-2 hover:bg-green-500 rounded-md" type="submit" id="card-button" >Update Card</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
