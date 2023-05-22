<?php

namespace App\Http\Requests;

use App\Models\Bank;
use App\Models\Branch;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BankBranchDetailsRequest extends FormRequest
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


    public function checkForUniqueBranch($branch_code = '', $bank_code = '', $branch_name = ''){

        $bank = Bank::join('branch', 'branch.bank_code', '=', 'bank.code')
        ->where('branch.bank_code', $bank_code)
        ->selectRaw('branch.branch_code,branch.name')
        ->get();
        if(!empty($branch_code) && $bank->contains('branch_code',$branch_code))
            {
                throw ValidationException::withMessages(['branchCode' => 'This branch code is already taken']);
            }
        if(!empty($branch_name) && $bank->contains('name',$branch_name)){
                
                throw ValidationException::withMessages(['branchName' => 'This branch name is already taken']);
            }
      

    }
    public function createRules()
    {
        self::checkForUniqueBranch(request()->branchCode, request()->bankCode, request()->branchName);
        
        $rules = [
            'branchName' => 'required|max:200|min:1|regex:/^[a-zA-Z0-9_ ]*$/', //AR 11/2/2022
            // 'branchName' => 'required|max:200|min:1|unique:branch,name|regex:/^[a-zA-Z0-9_ ]*$/',
            'branchCode' => 'required|max:10|min:4|regex:/^[a-zA-Z0-9]*$/',
            // 'note' => 'max:300|min:3|regex:/^[ a-zA-Z\s]+$/',
            // 'note' => 'max:300',
            
        ];
        

        if ($this->post('note') != "") {

            $note = [
                'note' => 'max:300|min:3|nullable|regex:/^[a-zA-Z0-9\s.,_&()\/@#%*-]+$/',
            ];
            $rules = array_merge($rules, $note);
        }
        return $rules;
    }
    
    public function updateRules()
    {
        
        $editable_branch = (new Branch)->getSelectedBranch(request()->branchId) ?? [];
        if ($editable_branch[0]['branch_code'] != request()->branchCode) {
            self::checkForUniqueBranch(request()->branchCode, request()->bankCode, '');
        }
        if ($editable_branch[0]['name'] != request()->branchName) {
            self::checkForUniqueBranch('', request()->bankCode, request()->branchName);
        }
       
        // $rules = [
            //     'branchName' => 'required|max:200|min:1|regex:/^[a-zA-Z0-9_ ]*$/',
            //     'branchCode' => 'required|max:10|min:3|regex:/^[a-zA-Z0-9]*$/',
            
            // ];
            $rules['branchName'] ='required|max:200|min:1|regex:/^[a-zA-Z0-9_ ]*$/';
            $rules['branchCode'] ='required|max:200|min:4|regex:/^[a-zA-Z0-9_ ]*$/';
        if ($this->post('note') != "") {
            $note = [
                'note' => 'max:300|min:3|nullable|regex:/^[a-zA-Z0-9\s.,_&()\/@#%*-]+$/',
            ];
            $rules = array_merge($rules, $note);
        }

        return $rules;
    }


    public function messages()
    {
        return [

            'branchName.required' => 'Please enter the branch name.',
            'branchName.min' => 'The branch name must be at least 1 character.',
            'branchName.max' => 'The branch name cannot be greater than 200 character.',
            'branchName.regex' => 'The branch name format is invalid.',

            'branchCode.required' => 'Please enter the branch code.',
            'branchCode.min' => 'The branch code must be at least 4 character.',
            'branchCode.max' => 'The branch code cannot be greater than 10 character.',
            'branchCode.regex' => 'The branch code format is invalid.',

            
            'note.max' => 'The note cannot be greater than 300 character.',
            'note.regex' => 'The note format is invalid.',


        ];
    }

    public function filters()
    {
        return [
            'branchName' => 'trim|escape',
            'branchCode' => 'trim|escape',
            'note' => 'trim|escape',

        ];
    }
}
