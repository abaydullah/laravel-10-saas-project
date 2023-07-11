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
                    <form class="divide-y w-full" action="{{ route('account.subscription.card.store') }}" method="post">
                        @csrf
                        <span class="text-sm mb-5">Your new card will be used for future payments.</span><br>
                        <div>
                            <x-input-label for="card-holder-name" :value="__('Holder Name')" />
                            <x-text-input id="card-holder-name" class="block mt-1 w-full" type="text" name="name" autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <label for="">Card details</label>
                            <div id="card-element"></div>
                        </div>
                        <button class="bg-green-200 px-4 py-2 hover:bg-green-500 rounded-md" type="submit" id="card-button" data-secret="{{ $intent->client_secret }}">Update Card</button>
                    </form>
                </div>
            </div>
        </div>
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
