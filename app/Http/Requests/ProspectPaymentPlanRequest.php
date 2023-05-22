<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProspectPaymentPlanRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        // echo'<pre>';
        // print_r($this->post()); exit;
        // print_r($this->isMethod('post')); exit;


        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }


    public function createRules()
    {

        $rules = [
            'planName' => 'required|max:100|min:1|regex:/^[a-z0-9-]+$/',
            'perPaymentLimit' => 'required|max:11|min:1|regex:/^[.0-9]+$/',//regex:/^\\-?([0-9]+(?:\\.[0-9]{2}))?$/',
            'pcardProcessingFee' => 'required|max:11|min:1|regex:/^[.0-9]+$/',
            'pmonthlyTotalLimit' => 'required|max:11|min:1|regex:/^[.0-9]+$/',
            'pmonthlyFeeMpay' => 'required|max:11|min:1|regex:/^[.0-9]+$/',
            'ptokenizationFeeMpay' => 'required|max:11|min:1|regex:/^[.0-9]+$/',

        ];
        return $rules;
    }

    public function updateRules()
    {
        $rules = [
            'planName' => 'required|max:10|min:1|regex:/^[0-9]+$/',
            'perPaymentLimit' => 'required|max:11|min:1|regex:/^[.0-9]+$/',
            'pcardProcessingFee' => 'required|max:11|min:1|regex:/^[.0-9]+$/',
            'pmonthlyTotalLimit' => 'required|max:11|min:1|regex:/^[.0-9]+$/',
            'pmonthlyFeeMpay' => 'required|max:11|min:1|regex:/^[.0-9]+$/',
            'ptokenizationFeeMpay' => 'required|max:11|min:1|regex:/^[.0-9]+$/',
            // $rules = ['monthlyTotalLimit' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',];

        ];

        return $rules;
    }

    public function messages()
    {
        return [

        'planName.required' => 'Please select the plan name .',
        'planName.min' => 'The plan name must be at least 1 character.',
        'planName.max' => 'The plan name cannot be greater than 4 characters.',
        'planName.regex' => 'The plan name format is invalid.',

        'ptokenizationFeeMpay.required' => 'Please enter the tokenization fee .',
        'ptokenizationFeeMpay.min' => 'The tokenization fee must be at least 1 character.',
        'ptokenizationFeeMpay.max' => 'The tokenization fee cannot be greater than 11 characters.',
        'ptokenizationFeeMpay.regex' => 'The tokenization fee format is invalid.',

        'pcardProcessingFee.required' => 'Please enter the card processing fee .',
        'pcardProcessingFee.min' => 'The card processing fee must be at least 1 character.',
        'pcardProcessingFee.max' => 'The card processing fee cannot be greater than 11 characters.',
        'pcardProcessingFee.regex' => 'The card processing fee format is invalid.',

        'pmonthlyFeeMpay.required' => 'Please enter the monthly fee .',
        'pmonthlyFeeMpay.min' => 'The monthly fee must be at least 1 character.',
        'pmonthlyFeeMpay.max' => 'The monthly fee cannot be greater than 11 characters.',
        'pmonthlyFeeMpay.regex' => 'The monthly fee format is invalid.',

        'pmonthlyTotalLimit.required' => 'Please enter the monthly total limit.',
        'pmonthlyTotalLimit.min' => 'The monthly total limit must be at least 1 character.',
        'pmonthlyTotalLimit.max' => 'The monthly total limit cannot be greater than 11 characters.',
        'pmonthlyTotalLimit.regex' => 'The monthly total limit format is invalid.',

        'perPaymentLimit.required' => 'Please enter the per payment limit.',
        'perPaymentLimit.min' => 'The per payment limit must be at least 1 character.',
        'perPaymentLimit.max' => 'The per payment limit cannot be greater than 11 characters.',
        'perPaymentLimit.regex' => 'The per payment limit format is invalid.',

        ];
    }

    public function filters()
    {
        return [
            'planName' => 'trim|escape',
            'perPaymentLimit' => 'trim|escape',
            'pcardProcessingFee' => 'trim|escape',
            'pmonthlyFeeMpay' => 'trim|escape',
            'ptokenizationFeeMpay' => 'trim|escape',
            'monthlyTotalLimit' => 'trim|escape',
        ];
    }
}
