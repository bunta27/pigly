<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->routeIs('register.step1.store')) {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
            ];
        }

        if ($this->routeIs('register.step2.store')) {

            $decimalRule = ['required','max:999.9','regex:/^\d{1,4}(\.\d)?$/'];

            return [
                'weight' => $decimalRule,
                'target_weight' => $decimalRule,
            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',

            'weight.required' => '現在の体重を入力してください',
            'weight.max' => '4桁までの数字で入力してください',
            'weight.regex' => '小数点は1桁で入力してください',
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.max' => '4桁までの数字で入力してください',
            'target_weight.regex' => '小数点は1桁で入力してください',
        ];
    }
}
