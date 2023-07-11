<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

                        {{ $header }}
                    </div>

                </header>
                @include('layouts.alerts')
            @endif

            <!-- Page Content -->
            <main>

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                            <div class="flex">
                                <div class="w-3/12">
                                    <div class=" w-full">
                                        <ul class="divide-y">
                                            <li class="px-3 py-4 bg-gray-100 hover:bg-gray-400 rounded-sm transition {{ return_if(on_page('account'),'bg-gray-600 text-white font-bold') }}"><a href="{{route('account.index')}}" class=" ">Account Overview</a></li>
                                            <li class="px-3 py-4 bg-gray-100 hover:bg-gray-400 rounded-sm transition {{ return_if(on_page('profile'),'bg-gray-600 text-white font-bold')}}"><a href="{{route('profile.edit')}}" class="">Profile</a></li>
                                            <li class="px-3 py-4 bg-gray-100 hover:bg-gray-400 rounded-sm transition {{ return_if(on_page('account/deactivate'),'bg-gray-600 text-white font-bold')}}"><a href="{{route('account.deactivate.index')}}" class="">Account Deactivate</a></li>
                                            <li class="px-3 py-4 bg-gray-100 hover:bg-gray-400 rounded-sm transition {{ return_if(on_page('account/twofactor'),'bg-gray-600 text-white font-bold')}}"><a href="{{route('account.twofactor.index')}}" class="">Two Factor Authenticate</a></li>
                                        </ul>

                                    </div>
                                    <div class=" w-full mt-5">
                                        @subscribed
                                        <ul class="divide-y">
                                            @subscriptionnotcancelled
                                            <li class="px-3 py-4 bg-gray-100 hover:bg-gray-400 rounded-sm transition {{ return_if(on_page('account/subscription/swap'),'bg-gray-600 text-white font-bold') }}">
                                                <a href="{{route('account.subscription.swap.index')}}" class=" ">Change Plan</a></li>
                                            <li class="px-3 py-4 bg-gray-100 hover:bg-gray-400 rounded-sm transition {{ return_if(on_page('account/subscription/cancel'),'bg-gray-600 text-white font-bold') }}">
                                                <a href="{{route('account.subscription.cancel.index')}}" class="">Cancel Subscription</a></li>
                                            @endsubscriptionnotcancelled
                                            @subscriptioncancelled
                                            <li class="px-3 py-4 bg-gray-100 hover:bg-gray-400 rounded-sm transition {{ return_if(on_page('account/subscription/resume'),'bg-gray-600 text-white font-bold') }}">
                                                <a href="{{route('account.subscription.resume.index')}}" class="">Resume Subscription</a></li>
                                            @endsubscriptioncancelled
                                            <li class="px-3 py-4 bg-gray-100 hover:bg-gray-400 rounded-sm transition {{ return_if(on_page('account/subscription/card'),'bg-gray-600 text-white font-bold') }}">
                                                <a href="{{route('account.subscription.card.index')}}" class="">Update Card</a></li>
                                            @teamsubscription
                                            <li class="px-3 py-4 bg-gray-100 hover:bg-gray-400 rounded-sm transition {{ return_if(on_page('account/subscription/team'),'bg-gray-600 text-white font-bold') }}">
                                                <a href="{{route('account.subscription.team.index')}}" class="">Manage Team</a></li>
                                            @endteamsubscription
                                        </ul>
                                        @endsubscribed

                                    </div>
                                </div>
                                <div class="w-9/12">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </main>
        </div>
    @yield('script')
    </body>
</html>
