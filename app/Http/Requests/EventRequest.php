<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Auth;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function response(array $errors)
    {
        return $this->redirector->back()->withInput()->withErrors($errors, $this->errorBag);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules['promo_id'] = 'required';
        $rules['title'] = 'required';
        $rules['from'] = 'required';
        $rules['to'] = 'required';
        $rules['description'] = 'required';

        return $rules;
    }

    public function messages() {
        return [
            'promo_id.required' => 'The Promotion is required',
            'title.required' => 'The title is required',
            'from.required' => 'The from date is required',
            'to.required' => 'The to date is required',
            'description.required' => 'The description of event is required'
        ];
    }

}
