<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class BankDetailsRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules= [
            //'bankName' => 'required|max:100|min:1',
            'branchCode' => 'required|max:100|min:1',
            'bankCode' => 'required|max:4|min:1',
            //'branchName' => 'required|max:100|min:1',
            'accountHolderName' =>'required|max:300|regex:/^[a-zA-Z0-9\s.,_&()\/@#%*!-]+$/',//regex:/^[a-zA-Z0-9\s-]+$/
            'accountNumber' => 'required|max:20|regex:/^[a-zA-Z0-9\s-]+$/',
            'agreement' =>  'required'
        ];
        $input = request()->all();
        $signup = Session::get('ipg_signup');
        if($signup){
            $bank['bank'] = $input;
            Session::put('ipg_signup', array_merge($signup, $bank));
        }
        return $rules;
    }


    public function messages(){
        return [
            'bankName.required' => 'Please select the bank name.',
            'bankName.min' => 'The bank name must be at least 1 character.',
            'bankName.max' => 'The bank name cannot be greater than 100 character.',

            'branchCode.required' => 'Please select the branch code.',
            'branchCode.min' => 'The branch code must be at least 1 character.',
            'branchCode.max' => 'The branch code cannot be greater than 100 character.',

            'accountHolderName.required' => "Please enter the account holder's name.",
            'accountHolderName.max' => "The account holder's name cannot be greater than 300 character.",
            'accountHolderName.regex' => "The account holder's format is invalid",

            'accountNumber.required' => 'Please enter the account number.',
            'accountNumber.max' => 'The account number cannot be greater than 20 character.',
            'accountNumber.regex' => 'The account number format is invalid.',

            'agreement.required' => 'Please enter the agreement.',

            'bankCode.required' => 'Please select the bank code.',
            'bankCode.min' => 'The bank code must be at least 1 character.',
            'bankCode.max' => 'The bank code cannot be greater than 4 character.',

            'branchName.required' => 'Please select the branch name.',
            'branchName.min' => 'The branch name must be at least 1 character.',
            'branchName.max' => 'The branch name cannot be greater than 100 character.'
        ];
    }

    public function filters()
    {
        return [
            'bankName' => 'trim|escape',
            'branchCode' => 'trim|escape',
            'accountHolderName' =>'trim|escape',
            'accountNumber' => 'trim|escape',
            'agreement' =>  'trim|escape'
        ];
    }
}
