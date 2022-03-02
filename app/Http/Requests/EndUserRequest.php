<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Auth;
class EndUserRequest extends FormRequest
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
        $rules = [
            'name' => "required"
        ];

        switch($this->method())
        {
            // Brand new user
            case 'POST':
            {
                $rules['email'] = 'required|email|unique:users,email';

                break;
            }

            // Save all fields
            case 'PUT':                
            {
                $rules['email'] = 'required';
            }
            default:break;
        }
        $rules['mobile'] = 'required';

        return $rules;

    }

}
