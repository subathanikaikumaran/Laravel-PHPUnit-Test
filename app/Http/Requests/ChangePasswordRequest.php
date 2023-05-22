<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [   
            
            'current_pwd' => 'required',
            'new_pwd' => 'required|min:7|max:100|regex:/^[a-zA-Z0-9\s-]+$/',
            'confirm_pwd' => 'required|same:new_pwd|min:7|max:100|regex:/^[a-zA-Z0-9\s-]+$/',
        ];

        return $rules;
    }



    public function messages()
    {
        return [
            'current_pwd.required' => 'Please enter the current password.',
            'new_pwd.required' => 'Please enter the new password.',
            'new_pwd.regex' => 'The new password should contain both numeric and alphabetic characters only.',
            'new_pwd.max' => 'The new password cannot be greater than 100 characters.',
            'new_pwd.min' => 'The new password must be at least 7 characters.'
        ,
        'confirm_pwd.required' => 'Please enter the confirm password.',
        'confirm_pwd.regex' => 'The confirm password should contain both numeric and alphabetic characters only.',
        'confirm_pwd.max' => 'The confirm password cannot be greater than 100 characters.',
        'confirm_pwd.min' => 'The confirm password must be at least 7 characters.',
        'confirm_pwd.same' => 'The confirm password and new password does not match.'
    ];
    }

    public function filters()
    {
        return [
            
            'user_password' => 'trim|escape',
            'confirm_password' => 'trim|escape'
        ];
    }
}
