<x-mail::message>
# Introduction

Please activate your account

<x-mail::button :url="route('activation.activate',$token)">
  Activate
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
