<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationCvRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = array(
            'firstName' => 'required',
            'lastName' => 'required',
            'country' => 'required',
            'language' => 'required',
            'gender' => 'required',
            'dateOfBirth' => 'required|date',
            'email' => 'required|email',
            'skype' => 'required',
            'phoneHome' => 'required',
            'phoneMobile' => 'required',
            'height' => 'required',
            'englishLevel' => 'required',
            'size' => 'required',
            'education' => 'required',
            'study' => 'required',
            'earliestDate' => 'required|date',
            'latestDate' => 'required|date',
            'drivingExperience' => 'required',
            'skills' => 'required',
            'otherLanguage' => 'required',
            'beforeUS' => 'required',
            'workExperience' => 'required',
            'location_id' => '',
            'sponsor_id' => 'required'

        );

        return $rules;
    }
}
