<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerchantTerminalUserRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }

    public function createRules()
    {
        $rules1= [];
        $rules['first_name'] = 'required|string|max:100|min:1|regex:/^[a-zA-Z\s]+$/';
        $rules['last_name'] = 'required|string|max:100|min:1|regex:/^[a-zA-Z\s]+$/';
        $rules['username'] = 'required|string|max:100|min:6|regex:/^[a-zA-Z0-9.,\-_]*$/';
        $rules['useremail'] = 'required|email|email:rfc,filter|max:100|min:5';
        $rules['pwd_type'] = 'required';
        // $rules['phoneNumber'] =>  ['required|min:10|regex:/^(0|\+\d{1,2})[\d ]*$/'];

        $rules = [
            'phoneNumber' =>  ['required','min:10','regex:/^(0|\+\d{1,2})[\d ]*$/']
            
        ];
        // $rules = [

        //     'first_name' => 'required|string|max:100|min:1|regex:/^[a-zA-Z\s]+$/',
        //     'last_name' => 'required|string|max:100|min:1|regex:/^[a-zA-Z\s]+$/',
        //     'username' => 'required|string|max:100|min:6|regex:/^[a-zA-Z\s]+$/',
        //     // 'role' => 'required',  //regex:/^[a-zA-Z]+$/',
        //     'useremail' => 'required|email|email:rfc,filter|max:100|min:5', //businessmail change
        //     'pwd_type' => 'required',
        //     'phoneNumber' =>  'required|min:10|regex:/^(?:0)[0-9]{9}+$/',
        // ];
        
        if (request()->pwd_type == 2) {
            $rules1=['cus_password' => 'required|string|max:100|min:7|regex:/^[a-zA-Z0-9\s-]+$/'];

        } 
        return array_merge($rules1, $rules);
    }
    public function messages()
    {
        return [
            'pwd_type.required' => 'Please select the password type.',

            'first_name.required' => 'Please enter the first name.',
            'first_name.regex' => 'The first name format is invalid.',
            'first_name.max' => 'The first name cannot be greater than 100 characters.',
            'first_name.min' => 'The first name cannot be less than 1 characters.',
            'first_name.string' => 'The first name format is invalid.',

            'last_name.required' => 'Please enter the last name.',
            'last_name.regex' => 'The last name format is invalid.',
            'last_name.max' => 'The last name cannot be greater than 100 characters.',
            'last_name.min' => 'The last name cannot be less than 1 characters.',
            'last_name.string' => 'The last name format is invalid.',

            'username.required' => 'Please enter the username.',
            'username.regex' => 'The username format is invalid.',
            'username.max' => 'The username cannot be greater than 100 characters.',
            'username.min' => 'The username cannot be less than 6 characters.',
            'username.string' => 'The username format is invalid.',

            // 'merchantId.required' => 'Please enter the merchantID.',
            // 'merchantId.regex' => 'The merchantID format is invalid.',

            // 'role.required' => 'Please select the merchant user role.',
            // 'role.regex' => 'Please select the merchant user role.',

            'useremail.required' => 'Please enter the business email.',
            'useremail.max' => 'The business email cannot be greater than 100 characters.',
            'useremail.min' => 'The business email cannot be less than 5 characters.',
            'useremail.email' => 'The business email format is invalid.',

            'phoneNumber.required' => 'Please enter the phone number.',
            'phoneNumber.regex' => 'Please enter a valid Phone number [Format : 07XXXXXXXX OR +XXxxxxxxxxx].',
            'phoneNumber.min' => 'The phone number must be at least 10 numbers.',

            'password.required' => 'Please enter the new password.',
            'password.regex' => 'The new password should contain both numeric and alphabetic characters.',
            'password.max' => 'The new password cannot be greater than 100 characters.',
            'password.min' => 'The new password cannot be less than 7 characters.',


            'cus_password.required' => 'Please enter a custom password.',
            'cus_password.regex' => 'The password should contain both numeric and alphabetic characters.',
            'cus_password.max' => 'The password cannot be greater than 100 characters.',
            'cus_password.min' => 'The new password cannot be less than 7 characters.',

        ];
    }
    public function filters()
    {
        return [

            'first_name' => 'trim|escape',
            'last_name' => 'trim|escape',
            'username' => 'trim|escape',
            'useremail' => 'trim|escape',
            'phoneNumber' => 'trim|escape',
            'password' => 'trim|escape',
            'cus_password' => 'trim|escape',



        ];
    }
}
