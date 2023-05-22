<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProspectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {       
        $rules= [];
        $rules1=['reason' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s-]+$/|min:1'];
        if($this->post('requestId')!="" && $this->post('requestId')==1){
            $rules= ['firstName' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s-]+$/|min:1'];
        }elseif($this->post('requestId')!="" && $this->post('requestId')==2){
            $rules= ['lastName' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s-]+$/|min:1'];
        }elseif($this->post('requestId')!="" && $this->post('requestId')==14){
            $rules= ['contactEmail' => 'required|email:rfc,filter|max:100|min:7'];
        }elseif($this->post('requestId')!="" && $this->post('requestId')==13){
            // $rules= ['mobile' =>  'required|min:10|regex:/^[0-9]+$/'];
            $rules= ['mobile' =>  'required|min:10|regex:/^(?:0)[0-9]{9}+$/'];
        }elseif($this->post('requestId')!="" && $this->post('requestId')==4){
            $rules= ['nic' => ['required', 'max:12', 'regex:/^([0-9]{9}[v|V|x|X]|[0-9]{12})$/']];
        }elseif($this->post('requestId')!="" && $this->post('requestId')==8){
            $rules= ['address' => 'required|min:5|max:300'];
        }elseif($this->post('requestId')!="" && $this->post('requestId')==3){
            $rules= ['mdob' =>'required|date|date_format:Y-m-d'];
        }
        elseif($this->post('requestId')!="" && $this->post('requestId')==9000){
            $rules= [
                'bankName' => 'required|max:100|min:1',
                'bankCode' => 'required|max:4|min:1',
                'branchName' => 'required|max:100|min:1',
                'branchCode' => 'required|max:4|min:1'
            ];
        }
        
        elseif($this->post('requestId')!="" && $this->post('requestId')==16){
            $businessOwnership=$this->post('businessOwnership');
            if($businessOwnership!=1){
                $rules=[
                    'businessRegNo' =>'required|max:100|min:1',
                    'businessRegDate' => 'required|date|date_format:Y-m-d',
                    'brImg' =>  'image|mimes:jpeg,png,jpg|max:2000',//required|
                ];
            }
        }
        
        elseif($this->post('requestId')!="" && $this->post('requestId')==15){
            $rules= ['businessName' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s.,_&()\/@#%*!-]+$/'];
        }
        elseif($this->post('requestId')!="" && $this->post('requestId')==20){
            $rules= ['description'=>'max:300'];
        }
        elseif($this->post('requestId')!="" && $this->post('requestId')==27){
            // $rules= ['businessMobile' =>  'required|min:10|regex:/^[0-9]+$/'];
            $rules= ['businessMobile' =>  'required|min:10|regex:/^(?:0)[0-9]{9}+$/'];
        }
        elseif($this->post('requestId')!="" && $this->post('requestId')==28){
            $rules= ['businessEmail' => 'required|email:rfc,filter|max:100|min:7'];
        }
        elseif($this->post('requestId')!="" && $this->post('requestId')==22){
            $rules= ['bAddress' => 'required|min:5|max:300'];
        }


        elseif($this->post('requestId')!="" && $this->post('requestId')==34){
            $rules= ['accountHolderName' =>'required|max:300|regex:/^[a-zA-Z0-9\s.,_&()\/@#%*!-]+$/'];
        }
        elseif($this->post('requestId')!="" && $this->post('requestId')==35){
            $rules= ['accountNumber' => 'required|max:20|regex:/^[a-zA-Z0-9\s-]+$/'];
        }elseif($this->post('requestId')!="" && $this->post('requestId')==38){
            $rules= ['maximumTrxnAmount' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',];//|max:10000
        }

        /*
        *payment validation rules
        */ elseif ($this->post('requestId') != "" && $this->post('requestId') == 41) {
            $rules = ['tokenizationFee' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',];
        } elseif ($this->post('requestId') != "" && $this->post('requestId') == 42) {
            $rules = ['cardProcessingFee' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',];
        } elseif ($this->post('requestId') != "" && $this->post('requestId') == 43) {
            $rules = ['monthlyFee' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',];
        } elseif ($this->post('requestId') != "" && $this->post('requestId') == 44) {
            $rules = ['perPaymentLimit' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',];
        } elseif ($this->post('requestId') != "" && $this->post('requestId') == 45) {
            $rules = ['monthlyTotalLimit' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',];
        } elseif ($this->post('businessweb') != "" && $this->post('requestId') == 29) {
            $rules = ['businessweb' => 'max:100|min:1|regex:/^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/',];
        } elseif ($this->post('fbweb') != "" && $this->post('requestId') == 30) {
            $rules = ['fbweb' => 'max:100|min:1|regex:/^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/',];
        } elseif ($this->post('instaweb') != "" && $this->post('requestId') == 31) {
            $rules = ['instaweb' => 'max:100|min:1|regex:/^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/',];
        }

        /*
        *Master payment plan validation
        */

        // elseif ($this->post('requestId') != "" && $this->post('requestId') == 40) {
        //     $rules = ['planName' => 'required|regex:/^[a-z0-9-]+$/'];
        // }


        elseif ($this->post('planType') != "" && $this->post('planType') == 'Advanced') {
            $rules = [
                'pmonthlyFeeMpay' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
                'ptokenizationFeeMpay' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
                'planName' => 'required|regex:/^[a-z0-9-]+$/',


            ];
        }

        return array_merge($rules1, $rules);
    }


    public function messages(){
        $messages_link = [];
        if($this->post('businessweb') != "" && $this->post('requestId') == 29){
            $messages_link =  [
                'businessweb.max' => 'The Business Website cannot be greater than 100 characters.',
                'businessweb.min' => 'The Business Website must be at least 1 character.',
                'businessweb.regex' => 'The Business Website is invalid.'
         ];
        }
        elseif($this->post('fbweb') != "" && $this->post('requestId') == 30){
            $messages_link =  [
                'fbweb.max' => 'The Facebook link cannot be greater than 100 characters.',
                'fbweb.min' => 'The Facebook link must be at least 1 character.',
                'fbweb.regex' => 'The Facebook link is invalid.'
         ];
        }
        elseif($this->post('instaweb') != "" && $this->post('requestId') == 31){
            $messages_link =  [
                'instaweb.max' => 'The Instagram link cannot be greater than 100 characters.',
                'instaweb.min' => 'The Instagram link must be at least 1 character.',
                'instaweb.regex' => 'The Instagram link is invalid.'
         ];
        }
        $messages =  [
       
            'maximumTrxnAmount.required' => 'Please enter the max trxn amount.',
            'maximumTrxnAmount.numeric' => 'The max trnx format is invalid.',
            'maximumTrxnAmount.required' => 'The max trnx format is invalid.',

            'firstName.required' => 'Please enter the first name.',
            'firstName.regex' => 'The first name format is invalid.',
            'firstName.min' => 'The first name must be at least 1 character.',
            'firstName.max' => 'The first name cannot be greater than 100 characters.',

            'lastName.required' => 'Please enter the last name.',
            'lastName.regex' => 'The last name format is invalid.',
            'lastName.min' => 'The last name must be at least 1 character.',
            'lastName.max' => 'The last name cannot be greater than 100 characters.',

            'mdob.required' => 'Please enter the date of birth.',
            'mdob.date' => 'The date of birth format is invalid.',
            'mdob.date_format' => 'The date of birth format is invalid.',

            'nic.regex' => 'The NIC no format is invalid.',
            'nic.required' => 'Please enter the NIC No.',
            'nic.max' => 'Old NIC No, cannot be less than 9 digits and 1 letter.
                         New NIC No, cannot be greater than 12 digits.',

            'mobile.required' => 'Please enter the mobile number.',
            'mobile.regex' => 'The mobile number format is invalid.',
            'mobile.min' => 'The mobile number must be at 10 characters.',

            'contactEmail.required' => 'Please enter the email.',
            'contactEmail.min' => 'The email must be at least 7 character.',
            'contactEmail.max' => 'The email cannot be greater than 100 characters.',

            'address.required' => 'Please enter the address.',
            'address.min' => 'The address must be at least 5 character.',
            'address.max' => 'The address cannot be greater than 300 characters.',

            'province.required' => 'Please select the province.',
            'province.min' => 'The province must be at least 1 character.',
            'province.max' => 'The province cannot be greater than 100 characters.',

            'district.required' => 'Please select the district.',
            'district.min' => 'The district must be at least 1 character.',
            'district.max' => 'The district cannot be greater than 100 characters.',

            'town.required' => 'Please select the town.',
            'town.min' => 'The town must be at least 1 character.',
            'town.max' => 'The town cannot be greater than 100 characters.',

            'postalCode.required' => 'Please enter the postal code.',
            'postalCode.min' => 'The postal code must be at least 5 character.',
            'postalCode.max' => 'The postal code cannot be greater than 5 characters.',

            'uploadOptoion.required' => 'Please select the upload option.',

            'uploadImage.required' => 'Please upload the image.',
            'uploadImage.max' => 'Image cannot be greater than 2MB',
            'uploadImage.mimes' => 'Please upload a JPG or PNG file.',

            'businessName.required' => 'Please enter the business name.',
            'businessName.regex' => 'The business name format is invalid.',
            'businessName.min' => 'The business name must be at least 1 character.',
            'businessName.max' => 'The business name cannot be greater than 100 characters.',

            'description.max' => 'The description cannot be greater than 300 characters.',

            'businessMobile.required' => 'Please enter the business phone.',
            'businessMobile.regex' => 'The business phone format is invalid.',
            'businessMobile.min' => 'Business phone cannot be less than 10 number.',

            'businessEmail.required' => 'Please enter the business email.',
            'businessEmail.min' => 'Business email cannot be less than 7 character.',
            'businessEmail.max' => 'The business email cannot be greater than 100 characters.',

            'bAddress.required' => 'Please enter the business address.',
            'bAddress.min' => 'The business address must be at least 5 character.',
            'bAddress.max' => 'The business address cannot be greater than 300 characters.',

            'bProvince.required' => 'Please select the province.',
            'bProvince.min' => 'The province must be at least 1 character.',
            'bProvince.max' => 'The province cannot be greater than 100 characters.',

            'bDistrict.required' => 'Please select the district.',
            'bDistrict.min' => 'The district must be at least 1 character.',
            'bDistrict.max' => 'The district cannot be greater than 100 characters.',

            'bTown.required' => 'Please select the town.',
            'bTown.min' => 'The town must be at least 1 character.',
            'bTown.max' => 'The town cannot be greater than 100 characters.',

            'bPostalCode.required' => 'Please enter the postal code.',
            'bPostalCode.min' => 'The postal code name must be at least 5 character.',
            'bPostalCode.max' => 'The postal code cannot be greater than 100 characters.',

            'businessWebsite.max' => 'The business website cannot be greater than 100 characters.',
            'fblink.max' => 'The facebook link cannot be greater than 100 characters.',
            'inslink.max' => 'The instagram link cannot be greater than 100 characters.',

            'accountHolderName.required' => "Please enter the account holder's name.",
            'accountHolderName.max' => "The account holder's name cannot be greater than 300 characters.",
            'accountHolderName.regex' => "Please enter valid data for account holder's name.",

            'accountNumber.required' => 'Please enter the account number.',
            'accountNumber.max' => 'The account number cannot be greater than 20 characters.',
            'accountNumber.regex' => 'The account number format is invalid',

            'bankName.required' => 'Please select the bank name.',
            'bankName.min' => 'The bank name must be at least 1 character.',
            'bankName.max' => 'The bank name cannot be greater than 100 characters.',

            'bankCode.required' => 'Please select the bank.',
            'bankCode.min' => 'The bank code must be at least 1 character.',
            'bankCode.max' => 'The bank code cannot be greater than 4 characters.',

            'branchName.required' => 'Please select the branch name.',
            'branchName.min' => 'The branch name must be at least 1 character.',
            'branchName.max' => 'The branch name cannot be greater than 100 characters.',

            'branchCode.required' => 'Please select the branch.',
            'branchCode.min' => 'The branch code must be at least 1 character.',
            'branchCode.max' => 'The branch code cannot be greater than 4 characters.',



            // payment validation msg **
            'planName.required' => 'Please select the plan name .',
            'planName.min' => 'The plan name must be at least 1 character.',
            'planName.max' => 'The plan name cannot be greater than 4 characters.',
            'planName.regex' => 'The plan name format is invalid.',

            'tokenizationFee.required' => 'Please enter the tokenization fee .',
            'tokenizationFee.min' => 'The tokenization fee must be at least 1 character.',
            'tokenizationFee.max' => 'The tokenization fee cannot be greater than 4 characters.',
            'tokenizationFee.regex' => 'The tokenization fee format is invalid..',

            'cardProcessingFee.required' => 'Please enter the card processing fee .',
            'cardProcessingFee.min' => 'The card processing fee must be at least 1 character.',
            'cardProcessingFee.max' => 'The card processing fee cannot be greater than 4 characters.',
            'cardProcessingFee.regex' => 'The card processing fee format is invalid.',

            'monthlyFee.required' => 'Please enter the monthly fee .',
            'monthlyFee.min' => 'The monthly fee must be at least 1 character.',
            'monthlyFee.max' => 'The monthly fee cannot be greater than 4 characters.',
            'monthlyFee.regex' => 'The monthly fee format is invalid.',

            'monthlyTotalLimit.required' => 'Please enter the monthly total limit.',
            'monthlyTotalLimit.min' => 'The monthly total limit must be at least 1 character.',
            'monthlyTotalLimit.max' => 'The monthly total limit cannot be greater than 4 characters.',
            'monthlyTotalLimit.regex' => 'The monthly total limit format is invalid..',

            'perPaymentLimit.required' => 'Please enter the per payment limit.',
            'perPaymentLimit.min' => 'The per payment limit must be at least 1 character.',
            'perPaymentLimit.max' => 'The per payment limit cannot be greater than 4 characters.',
            'perPaymentLimit.regex' => 'The per payment limit format is invalid.',

            //maseter payment validation msg
            'pmonthlyFeeMpay.required' => 'Please enter the monthly fee.',
            'pmonthlyFeeMpay.min' => 'The monthly fee must be at least 1 character.',
            'pmonthlyFeeMpay.max' => 'The monthly fee cannot be greater than 4 characters.',
            'pmonthlyFeeMpay.regex' => 'The monthly fee format is invalid.',

            'ptokenizationFeeMpay.required' => 'Please enter the tokenization fee .',
            'ptokenizationFeeMpay.min' => 'The tokenization fee must be at least 1 character.',
            'ptokenizationFeeMpay.max' => 'The tokenization fee cannot be greater than 4 characters.',
            'ptokenizationFeeMpay.regex' => 'The tokenization fee format is invalid.',

        ];
        return array_merge($messages_link, $messages);
    }

    public function filters()
    {
        return [
            'firstName' => 'trim|escape',
            'lastName' => 'trim|escape',
            'mdob' => 'trim|escape',
            'nic' => 'trim|escape',
            'mobile' => 'trim|escape',
            'contactEmail' => 'trim|escape',
            'address' => 'trim|escape',
            'province' => 'trim|escape',
            'district' => 'trim|escape',
            'town' => 'trim|escape',
            'postalCode' => 'trim|escape',
            'uploadOptoion' => 'trim|escape',
            'districtName'=> 'trim|escape',
            'townName'=> 'trim|escape',
            'businessName'=> 'trim|escape',

            //payment **
            'planName' => 'trim|escape',
            'tokenizationFee' => 'trim|escape',
            'cardProcessingFee' => 'trim|escape',
            'monthlyFee' => 'trim|escape',
            'perPaymentLimit' => 'trim|escape',
            'monthlyTotalLimit' => 'trim|escape',

            'pmonthlyFeeMpay' => 'trim|escape',
            'ptokenizationFeeMpay' => 'trim|escape',
        ];
    }
}
