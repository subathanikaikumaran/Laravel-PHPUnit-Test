<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerchantDetailsRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        $rules= [
            'firstName' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s-]+$/|min:1',
            'lastName' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s-]+$/|min:1',
            'mdob' =>'required|date|date_format:Y-m-d|before_or_equal:today',
            'nic' => ['required', 'max:12', 'regex:/^([0-9]{9}[v|V|x|X]|[0-9]{12})$/'],
            // 'mobile' =>  'required|min:10|regex:/^[0-9]+$/', (?:0)[0-9]{9}+$
            'mobile' =>  'required|min:10|regex:/^(?:0)[0-9]{9}+$/',
           
            'contactEmail' => 'required|email:rfc,filter|max:100|min:7',
            'address' => 'required|min:5|max:300',
            'province' => 'required|min:1|max:100',
            'district' => 'required|min:1|max:100',
            'town' => 'required|min:1|max:100',
            'postalCode' => 'required|min:5|max:5',
            'uploadOptoion' => 'required',
        ];
        if($this->post('uploadOptoion')!=""){
            $docImg=[
                'uploadImage' => 'image|mimes:jpeg,png,jpg|max:2000'//required|
            ];
            $rules = array_merge($rules, $docImg); 
        }

        return $rules;
    }


    public function messages(){
        return [
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
            'mdob.before_or_equal' => 'The date of birth must be a past date.',

            'nic.regex' => 'The NIC no format is invalid.',
            'nic.required' => 'Please enter the NIC No.',
            'nic.max' => 'Old NIC No, cannot be less than 9 digits and 1 letter.
                         New NIC No, cannot be greater than 12 digits.',

            'mobile.required' => 'Please enter the mobile number.',
            'mobile.regex' => 'The mobile no format is invalid.',
            'mobile.min' => 'The mobile no must be at least 10 characters.',

            'contactEmail.required' => 'Please enter the email.',
            'contactEmail.min' => 'The email must be at least 7 character.',
            'contactEmail.max' => 'The email must be at least 10 characters.',

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
            'town.max' => 'The town cannot be greater than 100 characters',

            'postalCode.required' => 'Please enter the postal code.',
            'postalCode.min' => 'The postal code must be at least 5 character.',
            'postalCode.max' => 'The postal code cannot be greater than 5 characters',

            'uploadOptoion.required' => 'Please select the upload option.',

            'uploadImage.required' => 'Please upload the image.',
            'uploadImage.max' => 'Image cannot be greater than 2MB',
            'uploadImage.mimes' => 'Please upload a JPG or PNG file.',
        ];
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
            'townName'=> 'trim|escape'
        ];
    }
}
