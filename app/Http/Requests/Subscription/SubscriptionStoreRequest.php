<?php

namespace App\Http\Requests\Subscription;

use App\Rules\ValidStripeCoupon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
          'plan' => ['required', Rule::exists('plans','gateway_id')->where(function ($q){
              $q->where('active',true);
          })],
          'token' => 'required',
            'coupon_code' => ['nullable', new ValidStripeCoupon()]
        ];
    }
}
