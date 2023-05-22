<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationRequest extends FormRequest
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
            'brand_name' => 'required|string|max:50|min:1|regex:/^[a-zA-Z0-9\s.\-_() ]+$/',
            'sms_msg' => 'required|string|max:70|min:15|regex:/^[a-zA-Z0-9\s.\-,_() ]+$/',
            'default_invoice_note' => 'nullable|string|max:300|min:15|regex:/^[a-zA-Z0-9\s.\-,_() ]+$/',
            'logo_url' => 'required|string|max:300|min:11',//|regex:/^((?!-)[A-Za-z0-9-]{3,63}(?<!-)\\.)+[A-Za-z]{2,4}$/
            'notify_url' => 'nullable|string|max:300|min:11'//|regex:/^((?!-)[A-Za-z0-9-]{3,63}(?<!-)\\.)+[A-Za-z]{2,4}$/
        ];

        return $rules;
    }

    public function updateRules()
    {

        $rules = [
            'brand_name' => 'required|string|max:50|min:1|regex:/^[a-zA-Z0-9\s.\-_() ]+$/',
            'sms_msg' => 'required|string|max:70|min:15|regex:/^[a-zA-Z0-9\s.\-,_() ]+$/',
            'default_invoice_note' => 'nullable|string|max:300|min:15|regex:/^[a-zA-Z0-9\s.\-,_() ]+$/',
            'logo_url' => 'required|string|max:300|min:11',//|regex:/^((?!-)[A-Za-z0-9-]{3,63}(?<!-)\\.)+[A-Za-z]{2,4}$/
            'notify_url' => 'nullable|string|max:300|min:11'//|regex:/^((?!-)[A-Za-z0-9-]{3,63}(?<!-)\\.)+[A-Za-z]{2,4}$/
            ,'reason' => 'required|string|max:100|regex:/^[a-zA-Z ]+$/|min:1'
        ];

        return $rules;
    }



    public function messages()
    {
        return [
            'brand_name.required' => 'Please enter the brand name.',
            'brand_name.regex' => 'The brand name format is invalid.',
            'brand_name.max' => 'The brand name cannot be greater than 50 characters.',

            'sms_msg.required' => 'Please enter the SMS message.',
            'sms_msg.regex' => 'The SMS message format is invalid.',
            'sms_msg.max' => 'The SMS message cannot be greater than 70 characters.',
            'sms_msg.min' => "The SMS message must be at least 15 characters.",

            'default_invoice_note.required' => 'Please enter the default invoice note.',
            'default_invoice_note.regex' => 'The default invoice note format is invalid.',
            'default_invoice_note.min' => 'The default invoice note cannot be greater than 15 characters.',
            'default_invoice_note.max' => "The default invoice note must be at least 300 characters.",

            'logo_url.required' => 'Please enter the merchant logo URL.',
            'logo_url.regex' => 'The merchant logo URL must be a valid web URL which begins with https.',
            'logo_url.max' => 'The merchant logo URL cannot be greater than 300 characters.',
            'logo_url.min' => "The merchant logo URL must be at least 11 characters.",

            'notify_url.required' => 'Please enter the merchant notification URL.',
            'notify_url.regex' => 'The merchant notification URL must be a valid web URL which begins with https.',
            'notify_url.min' => 'The merchant notification URL cannot be greater than 11 characters.',
            'notify_url.max' => "The merchant notification URL must be at least 300 characters.",


            

            'reason.required' => 'Please enter the reason.',
            'reason.regex' => 'The reason format is invalid.',
            'reason.max' => 'The reason cannot be greater than 100 characters.',



        ];
    }

    public function filters()
    {
        return [
            'brand_name' => 'trim|escape',
            'sms_msg' => 'trim|escape',
            'default_invoice_note' => 'trim|escape',
            'logo_url' => 'trim|escape',
            'notify_url' => 'trim|escape',
            'reason' => 'trim|escape'
        ];
    }
}

