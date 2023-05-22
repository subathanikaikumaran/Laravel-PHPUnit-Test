<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessDetailsRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules= [
            'businessName' => 'required|string|max:100|min:1|regex:/^[a-zA-Z0-9\s.,_&()\/@#%*!-]+$/',//|regex:/^[a-zA-Z0-9\s-]+$/
            'businessOwnership' => 'required|max:100|min:1',
            'businessCategory' => 'required|max:100|min:1',
            'businessCategoryCode'=>'required',
            'description'=>'max:300',
            'businessWebsite'=>'max:100',
            'fblink'=>'max:100',
            'inslink'=>'max:100'            
        ];
        if($this->post('businessOwnership')!=""){
           $businessOwnership=$this->post('businessOwnership');
            if($businessOwnership!=1){
                $ownership=[
                    'businessRegNo' =>'required|max:100|min:1',
                    'businessRegDate' => 'required|date|date_format:Y-m-d|before_or_equal:today',
                    'brImg' =>  'image|mimes:jpeg,png,jpg|max:2000',//required|
                ];
                $rules = array_merge($rules, $ownership);
            } 
        }
        if($this->post('isSameAddress')!='on'){
            $bAddress=[
                // 'businessMobile' =>  'required|min:10|regex:/^[0-9]+$/',
                'businessMobile' =>  'required|min:10|regex:/^(?:0)[0-9]{9}+$/',
                'businessEmail' => 'required|email:rfc,filter|max:100|min:7',
                'bAddress' => 'required|min:5|max:300',
                'bProvince' => 'required|min:1|max:100',
                'bDistrict' => 'required|min:1|max:100',
                'bTown' => 'required|min:1|max:100',
                'bPostalCode' => 'required|min:5|max:5'];
            $rules = array_merge($rules, $bAddress);
        }
        return $rules;
    }


    public function messages(){
        return [
            'businessName.required' => 'Please enter the business name.',
            'businessName.regex' => 'The business name format is invalid.',
            'businessName.min' => 'The business name must be at least 1 character.',
            'businessName.max' => 'The business name cannot be greater than 100 character.',

            'businessOwnership.required' => 'Please enter the business ownership.',
            'businessOwnership.min' => 'The business ownership must be at least 1 character.',
            'businessOwnership.max' => 'The business ownership cannot be greater than 100 character.',

            'businessRegNo.required' => 'Please enter the business registration no.',
            'businessRegNo.regex' => 'The business registration no format is invalid.',
            'businessRegNo.min' => 'The business registration no must be at least 1 character.',
            'businessRegNo.max' => 'The business registration no cannot be greater than 100 character.',

            'businessRegDate.required' => 'Please enter the Business registration date.',
            'businessRegDate.date' => 'The business registration date format is invalid',
            'businessRegDate.date_format' => 'The business registration date format is invalid.',
            'businessRegDate.before_or_equal' => 'The business registration date must be a past date.',

            'businessCategory.required' => 'Please enter the business category.',
            'businessCategory.min' => 'The business category must be at least 1 character.',
            'businessCategory.max' => 'The business category cannot be greater than 100 characters.',

            'businessCategoryCode.required' => 'Please enter the business category code.',

            'brImg.required' => 'Please upload the BR.',
            'brImg.max' => 'Image cannot be greater than 2MB',
            'brImg.mimes' => 'Please upload a JPG or PNG file.',

            'description.max' => 'The description cannot be greater than 300 characters.',

            'businessMobile.required' => 'Please enter the business phone.',
            'businessMobile.regex' => 'The business phone format is invalid.',
            'businessMobile.min' => 'The business phone must be at 10 character.',

            'businessEmail.required' => 'Please enter the business email.',
            'businessEmail.min' => 'The business email must be at least 7 character.',
            'businessEmail.max' => 'The business email cannot be greater than 100 characters.',

            'bAddress.required' => 'Please enter the business address.',
            'bAddress.min' => 'The business address must be at least 5 character.',
            'bAddress.max' => 'The business address cannot be greater than 100 characters.',

            'bProvince.required' => 'Please select the province.',
            'bProvince.min' => 'The province must be at least 1 character.',
            'bProvince.max' => 'The province cannot be greater than 100 characters.',

            'bDistrict.required' => 'Please select the district.',
            'bDistrict.min' => 'The distric must be at least 1 character.',
            'bDistrict.max' => 'The distric cannot be greater than 100 characters.',

            'bTown.required' => 'Please select the town.',
            'bTown.min' => 'The town must be at least 1 character.',
            'bTown.max' => 'The town cannot be greater than 100 characters.',

            'bPostalCode.required' => 'Please enter the postal code.',
            'bPostalCode.min' => 'The postal code must be at least 5 character.',
            'bPostalCode.max' => 'The postal code cannot be greater than 100 characters.',

            'businessWebsite.max' => 'The business website cannot be greater than 100 characters.',
            'fblink.max' => 'The facebook link cannot be greater than 100 characters.',
            'inslink.max' => 'The instagram link cannot be greater than 100 characters.' 
        ];
    }

    public function filters()
    {               
        return [
            'businessName' => 'trim|escape',
            'businessOwnership' => 'trim|escape',
            'businessCategory' => 'trim|escape',
            'businessCategoryCode' => 'trim|escape',
            'description' => 'trim|escape',
            'businessWebsite' => 'trim|escape',
            'fblink' => 'trim|escape',
            'inslink' => 'trim|escape',
            'businessRegNo' => 'trim|escape',
            'businessRegDate' => 'trim|escape',
            'brImg' => 'trim|escape',
            'businessMobile' => 'trim|escape',
            'businessEmail' => 'trim|escape',
            'bAddress' => 'trim|escape',
            'bProvince' => 'trim|escape',
            'bDistrict' => 'trim|escape',
            'bTown' => 'trim|escape',
            'bPostalCode' => 'trim|escape',
            'bDistrictName' => 'trim|escape',
            'bTownName' =>'trim|escape'
        ];
    }
}
