<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
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
            'roleId' => 'required',
            "permissions"    => "required|array|min:1"
        ];

        return $rules;
    }


    public function updateRules()
    {
        $rules = [
            'roleId' => 'required',
            "permissions"    => "required|array|min:1"
        ];


        return $rules;
    }






    public function messages()
    {
        return [
            'roleId.required' => 'Please select the user role.',
            'permissions.required' => 'Please select the permission.',
            'permissions.min' => 'Please select the permission.',
            'permissions.array' => 'Please select the permission.'


        ];
    }

    public function filters()
    {
        return [
            'roleId' => 'trim|escape',
            'permissions' => 'trim|escape'
        ];
    }
}
