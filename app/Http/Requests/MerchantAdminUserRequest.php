<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerchantAdminUserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

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
        $rules = [

            'first_name' => 'required|string|max:100|min:1|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|string|max:100|min:1|regex:/^[a-zA-Z\s]+$/',           
            // 'role' => 'required',  //regex:/^[a-zA-Z]+$/',
            'useremail' => 'required|email:rfc,filter|max:100|min:5', //businessmail change
        ];
        $rulePhone = [
            'phoneNumber' =>  ['required','min:10','regex:/^(0|\+\d{1,2})[\d ]*$/']
            
        ];

        return array_merge($rules,$rulePhone);
    }

    public function updateRules()
    {
        $rules = ['reason' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s-]+$/|min:1'];

        if ($this->post('requestId') != "" && $this->post('requestId') == 1) {
            $rules1 = ['first_name' => 'required|string|max:100|min:1|regex:/^[a-zA-Z\s]+$/'];
            $rules = array_merge($rules, $rules1);
        }

        if ($this->post('requestId') != "" && $this->post('requestId') == 2) {
            $rules1 = ['last_name' => 'required|string|max:100|min:1|regex:/^[a-zA-Z\s]+$/'];
            $rules = array_merge($rules, $rules1);
        }

        if ($this->post('requestId') != "" && $this->post('requestId') == 3) {
            $rules1 = ['bEmail' => 'required|email:rfc,filter|max:100|min:5'];
            $rules = array_merge($rules, $rules1);
        }

        if ($this->post('requestId') != "" && $this->post('requestId') == 5) {
            // $rules1 = ['phoneNumber' => 'required|min:10|regex:/^(?:\+94|0)[0-9]{9}$/'];
            $rules1 = [
                'phoneNumber' =>  ['required','min:10','regex:/^(0|\+\d{1,2})[\d ]*$/']
                
            ];
            // $rules1 = ['phoneNumber' => 'required|min:10|regex:/^(?:\+94|0)[0-9]{9}$/'];
            $rules = array_merge($rules, $rules1);
        }

        if ($this->post('requestId') != "" && $this->post('requestId') == 6) {
            $rules1 = ['password' => 'required|min:7|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'];
            $rules = array_merge($rules, $rules1);
        }


        return $rules;
    }


    public function messages()
    {
        return [
            'first_name.required' => 'Please enter the first name.',
            'first_name.regex' => 'The first name format is invalid.',
            'first_name.max' => 'The first name cannot be greater than 100 characters.',
            'first_name.min' => 'The first name cannot be less than 1 characters.',

            'last_name.required' => 'Please enter the last name.',
            'last_name.regex' => 'The last name format is invalid.',
            'last_name.max' => 'The last name cannot be greater than 100 characters.',
            'last_name.min' => 'The last name cannot be less than 1 characters.',

            // 'merchantId.required' => 'Please enter the merchantID.',
            // 'merchantId.regex' => 'The merchantID format is invalid.',

            'role.required' => 'Please select the merchant user role.',
            'role.regex' => 'Please select the merchant user role.',

            'useremail.required' => 'Please enter the business email.',
            'useremail.max' => 'The business email cannot be greater than 100 characters.',
            'useremail.min' => 'The business email cannot be less than 5 characters.',

            'phoneNumber.required' => 'Please enter the phone number.',
            'phoneNumber.regex' => 'Please enter a valid Phone number [Format : 07XXXXXXXX OR +XXxxxxxxxxx].',
            'phoneNumber.min' => 'The phone number must be at least 10 numbers.',

            'password.required' => 'Please enter the new password.',
            'password.regex' => 'The new password should contain both numeric and alphabetic characters.',
            'password.max' => 'The new password cannot be greater than 100 characters.',
            'password.min' => 'The new password cannot be less than 7 characters.',



        ];
    }

    public function filters()
    {
        return [

            'first_name' => 'trim|escape',
            'last_name' => 'trim|escape',
            // 'merchantId' => 'trim|escape',
            // 'merchantUserRoleId' => 'trim|escape',
            'useremail' => 'trim|escape',
            'phoneNumber' => 'trim|escape',
            'password' => 'trim|escape',



        ];
    }
}
