<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Account;


class AccountRequest extends FormRequest
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
        $account = Account::find($this->accounts);

    switch($this->method())
    {
        case 'GET':
        case 'DELETE':
        {
            return [];
        }
        case 'POST':
        {
         return [
                 'name' => 'required',
                 'status' => 'required',
                'phone' => 'required|max:25',
                'address_1' => 'required',
                // 'address_2' => 'required',
                // 'address_3' => 'required',
                'city' => 'required',
                'country_1' => 'required',
                'country_2' => 'required',
                'post_code' => 'required',
                'email_domain' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'account_no' => 'required',
                 // 'client_logo' => 'required',
                 // 'secondary_domain' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                // 'primary_contact' => 'required',
            'file' => 'max:5000|mimes:jpeg,jpg,gif,bmp,png|dimensions:width=150,height=150',            ];
        }
        case 'PUT':
        case 'PATCH':
        {
            return [
                // 'name' => 'required',
                //  'status' => 'required',
                'phone' => 'required|max:25',
                'address_1' => 'required',
                // 'address_2' => 'required',
                // 'address_3' => 'required',
                'city' => 'required',
                'country_1' => 'required',
                'country_2' => 'required',
                'post_code' => 'required',
                'email_domain' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                // 'secondary_domain' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                // 'account_no' => 'required',
                // 'primary_contact' => 'required',
                                // 'client_logo' => 'required',
            'file' => 'max:5000|mimes:jpeg,jpg,gif,bmp,png|dimensions:width=150,height=150',            ];
        }
        default:break;
    }
    }


    public function messages()
{
    return [
        'client_logo.required' => 'Client Logo is required.',
         'file.required' => 'Upload size not matched.',
    ];
}
}
