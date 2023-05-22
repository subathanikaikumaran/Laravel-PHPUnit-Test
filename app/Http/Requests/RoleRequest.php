<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'required|string|max:100|min:1|regex:/^[a-zA-Z0-9\s]+$/',            
            'description' => 'nullable|max:100|regex:/^[a-zA-Z0-9\s]+$/'//,
            // 'permissions' => 'required',
        ];
        
        return $rules;       
    }


    public function updateRules()
    {
        $rules=['reason' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s-]+$/|min:1'];
        if($this->post('requestId')!="" && $this->post('requestId')==1){
            $rules1= ['name' => 'required|string|max:100|min:1|regex:/^[a-zA-Z0-9\s]+$/'];
            $rules = array_merge($rules, $rules1);
        }

        if($this->post('requestId')!="" && $this->post('requestId')==2){
            $rules1= ['description' => 'nullable|max:100|regex:/^[a-zA-Z0-9\s]+$/'];
            $rules = array_merge($rules, $rules1);
        }
        if($this->post('requestId')!="" && $this->post('requestId')==3){
            $rules1= ['status' => 'required|not_in:0'];
            $rules = array_merge($rules, $rules1);
        }

        if($this->post('requestId')!="" && $this->post('requestId')==4){
            $rules1= ['permission' => 'required'];
            $rules = array_merge($rules, $rules1);
        }
       

        return $rules;
    }


    



    public function messages(){
        return [
            'name.required' => 'Please enter the role name.',
            'name.regex' => 'The role name format is invalid.',
            'name.max' => 'The role name cannot be greater than 100 characters.',

            'description.required' => 'Please enter the description',
            'description.regex' => 'The description format is invalid.',
            'description.max' => 'The description cannot be greater than 100 characters.',
            'permission.required' => 'Please assign the permissions.'
            
        ];
    }

    public function filters()
    {               
        return [
            'name' => 'trim|escape',            
            'description' => 'trim|escape'
        ];
    }
}
