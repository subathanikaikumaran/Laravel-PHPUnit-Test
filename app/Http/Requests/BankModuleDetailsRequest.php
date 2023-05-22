<?php

namespace App\Http\Requests;

use App\Models\Bank;
use Illuminate\Foundation\Http\FormRequest;

class BankModuleDetailsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // print_r($this->post()); exit;
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }

    public function createRules()
    {
        $rules = [
            'bankCode' => 'required|max:4|unique:bank,code|min:4|regex:/^[a-zA-Z0-9]*$/',
            'bankName' => 'required|max:200|min:1|regex:/^[a-zA-Z0-9_ ]*$/',
        ];
        if ($this->post('note') != "") {
            $note = [
                'note' => 'max:300|nullable|regex:/^[a-zA-Z0-9\s.,_&()\/@#%*-]+$/',
                // 'note' => 'max:300|nullable|regex:/^[a-zA-Z0-9_ ]*$/',
            ];
            $rules = array_merge($rules, $note);
        }
        return $rules;

    }

    public function updateRules()
    {
        $editable_bank = (new Bank)->getSelectedBank(request()->bankId) ?? [];
        
        if ($editable_bank[0]['code'] == request()->bankCode) {
            $rules['bankCode'] ='required|max:10|min:4|regex:/^[a-zA-Z0-9]*$/';
        }
        else{
            
            $rules['bankCode'] ='required|max:10|min:4|regex:/^[a-zA-Z0-9]*$/|unique:bank,code';
        }
        $rules['bankName'] = 'required|max:200|min:1|regex:/^[a-zA-Z0-9_ ]*$/';
        // $rules = [
        //     // 'bankCode' => 'required|max:10|min:4|regex:/^[a-zA-Z0-9]*$/|unique:bank,code',
        //     'bankName' => 'required|max:200|min:1|regex:/^[a-zA-Z0-9_ ]*$/',
        // ];
        if ($this->post('note') != "") {
            $note = [
                // 'note' => 'max:300|nullable', //AR
                'note' => 'max:300|nullable|regex:/^[a-zA-Z0-9\s.,_&()\/@#%*-]+$/',
            ];
            $rules = array_merge($rules, $note);
        }
        return $rules;

    }

    public function messages()
    {
        return [

            'bankName.required' => 'Please enter the bank name.',
            'bankName.min' => 'The bank name must be at least 1 character.',
            'bankName.max' => 'The bank name cannot be greater than 200 characters.',
            'bankName.unique' => 'The bank name already exist.',
            'bankName.regex' => 'The bank name format is invalid.',

            'bankCode.required' => 'Please enter the bank code.',
            'bankCode.min' => 'The bank code must be at least 4 characters.',
            'bankCode.max' => 'The bank code cannot be greater than 10 characters.',
            'bankCode.unique' => 'The bank code already exist.',
            'bankCode.regex' => 'The bank code format is invalid.',            
            
            'note.max' => 'The note cannot be greater than 300 characters.',
            'note.regex' => 'The note format is invalid.',

        ];
    }

    public function filters()
    {
        return [
            'bankName' => 'trim|escape',
            'branchCode' => 'trim|escape',
            'note' => 'trim|escape',

        ];
    }
}
