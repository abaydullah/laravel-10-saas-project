

@if(session()->has('success'))
 @component('layouts.alert_msg',['type' => 'bg-green-400'])
     {{ session('success') }}

 @endcomponent

@endif

@if(session()->has('error'))
    @component('layouts.alert_msg',['type' => 'bg-red-700'])
        {{ session('error') }}
    @endcomponent

@endif

