<x-app-layout>
    <div class="mb-4 text-sm text-gray-600 p-5">
        {{ __('Resend Activation Code.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
<div class="card">
    <form method="POST" action="{{ route('subscription.store') }}" class="px-5" id="payment-form">
    @csrf

    <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Plans')" />
            <select name="plan" id="plan" class="block mt-1 w-full">
                    @foreach($plans as $plan)

                <option value="{{$plan->gateway_id}}" {{request('plan') === $plan->slug ? 'selected' : ''}}>{{$plan->name}}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('plan')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="coupon_code" :value="__('Coupon Code')" />
            <x-text-input id="coupon_code" class="block mt-1 w-full" type="text" name="coupon_code" autofocus />
            <x-input-error :messages="$errors->get('coupon_code')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="card-holder-name" :value="__('Holder Name')" />
            <x-text-input id="card-holder-name" class="block mt-1 w-full" type="text" name="name" autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <label for="">Card details</label>
            <div id="card-element"></div>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button id="card-button" type="submit" data-secret="{{ $intent->client_secret }}">
                {{ __('Pay') }}
            </x-primary-button>


        </div>
    </form>
</div>
    @section('script')
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
{{--        <script src="https://checkout.stripe.com/checkout.js"></script>--}}
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe('{{ env('STRIPE_KEY') }}')

            const elements = stripe.elements()
            const cardElement = elements.create('card')

            cardElement.mount('#card-element')

            const form = document.getElementById('payment-form')
            const cardBtn = document.getElementById('card-button')
            const cardHolderName = document.getElementById('card-holder-name')

            form.addEventListener('submit', async (e) => {
                e.preventDefault()

                cardBtn.disabled = true
                const { setupIntent, error } = await stripe.confirmCardSetup(
                    cardBtn.dataset.secret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: {
                                name: cardHolderName.value
                            }
                        }
                    }
                )

                if(error) {
                    cardBtn.disable = false
                } else {
                    let token = document.createElement('input')
                    token.setAttribute('type', 'hidden')
                    token.setAttribute('name', 'token')
                    token.setAttribute('value', setupIntent.payment_method)
                    form.appendChild(token)
                    form.submit();
                }
            })
        </script>
{{--        <script>--}}

{{--            let handler = StripeCheckout.configure({--}}
{{--                key: '{{env('STRIPE_KEY')}}',--}}
{{--                locale: 'auto',--}}
{{--                token : function (token) {--}}
{{--                   let form = $('#payment-form')--}}
{{--                    $('#pay').prop('disabled',true)--}}
{{--                    $('<input>').attr({--}}
{{--                        type: 'hidden',--}}
{{--                        name: 'token',--}}
{{--                        value: token.id--}}
{{--                    }).appendTo(form)--}}

{{--                    form.submit();--}}
{{--                }--}}

{{--            })--}}

{{--            document.getElementById("pay").onclick = function(e) {--}}

{{--                handler.open({--}}
{{--                    name: 'AliSoftLTD',--}}
{{--                    description: 'Membership',--}}
{{--                    currency: 'usd',--}}
{{--                    key: '{{env('STRIPE_KEY')}}',--}}
{{--                    email: '{{auth()->user()->email}}'--}}
{{--                })--}}
{{--                e.preventDefault();--}}
{{--            };--}}
{{--        </script>--}}
    @endsection
</x-app-layout>


