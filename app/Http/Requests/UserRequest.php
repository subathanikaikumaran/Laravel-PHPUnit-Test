<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules= [
            'first_name' => 'required|string|max:100|min:1|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|string|max:100|min:1|regex:/^[a-zA-Z\s]+$/',
            'user_creation_name' => 'required|email:rfc,filter|max:100|min:1', // 
            // 'role' => 'required|not_in:0',            
            'user_creation_pwd' => 'required|string|max:100|min:7|regex:/^[a-zA-Z0-9\s-]+$/',// regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/ regex:/^[a-zA-Z0-9\s-]+$/
        ];
        
        return $rules;
    }

    public function updateRules()
    {
        $rules=['reason' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s-]+$/|min:1'];
        if($this->post('requestId')!="" && $this->post('requestId')==1){
            $rules1= ['first_name' => 'required|string|max:100|min:1|regex:/^[a-zA-Z\s]+$/'];
            $rules = array_merge($rules, $rules1);
        }

        if($this->post('requestId')!="" && $this->post('requestId')==2){
            $rules1= ['last_name' => 'required|string|max:100|min:1|regex:/^[a-zA-Z\s]+$/'];
            $rules = array_merge($rules, $rules1);
        }

        if($this->post('requestId')!="" && $this->post('requestId')==3){
            $rules1= ['username' => 'required|email:rfc,filter|max:100|min:1'];
            $rules = array_merge($rules, $rules1);
        }

        if($this->post('requestId')!="" && $this->post('requestId')==4){
            $rules1= ['status' => 'required|not_in:0'];
            $rules = array_merge($rules, $rules1);
        }

        if($this->post('requestId')!="" && $this->post('requestId')==5){
            $rules1= ['user_pwd' => 'required|string|max:100|min:7|regex:/^[a-zA-Z0-9\s-]+$/'];
            $rules = array_merge($rules, $rules1);
        }

        if($this->post('requestId')!="" && $this->post('requestId')==6){
            $rules1= ['role' => 'required|not_in:0'];
            $rules = array_merge($rules, $rules1);
        }

        return $rules;
    }



    public function messages(){
        return [
            'first_name.required' => 'Please enter the first name.',
            'first_name.regex' => 'The first name format is invalid.',
            'first_name.max' => 'The first name cannot be greater than 100 characters.',

            'last_name.required' => 'Please enter the last name.',
            'last_name.regex' => 'The last name format is invalid.',
            'last_name.max' => 'The last name cannot be greater than 100 characters.',


            'role.required' => 'Please select the user role.',
            'role.not_in' => 'Please select the user role.',


            'status.required' => 'Please select the user status.',
            'status.not_in' => 'Please select the user status.',

            'user_pwd.required' => 'Please enter the password',
            'user_pwd.regex' => 'The password should contain both alphabet and numeric characters',
            'user_pwd.min' => 'The password must be at least 7 characters.',
            'user_pwd.max' => 'The password cannot be greater than 100 characters.',

                  

            'username.required' => 'Please enter the username',
            'username.regex' => 'The username format is invalid.',
            'username.email' => 'The username format is invalid.',
            'username.max' => 'The username cannot be greater than 100 characters.',


            'user_creation_pwd.required' => 'Please enter the password',
            'user_creation_pwd.regex' => 'The password should contain both alphabet and numeric characters',
            'user_creation_pwd.min' => 'The password must be at least 7 characters.',
            'user_creation_pwd.max' => 'The password cannot be greater than 100 characters.',

                  

            'user_creation_name.required' => 'Please enter the username',
            'user_creation_name.regex' => 'The username format is invalid.',
            'user_creation_name.email' => 'The username format is invalid.',
            'user_creation_name.max' => 'The username cannot be greater than 100 characters.',

            

        ];
    }

    public function filters()
    {               
        return [
            'first_name' => 'trim|escape',
            'last_name' => 'trim|escape',
            'username' => 'trim|escape',            
            'role' => 'trim|escape',
            'user_pwd' => 'trim|escape'
        ];
    }
}
