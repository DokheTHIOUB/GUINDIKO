<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mentor_id'=>'required|',
            'mentore_id'=>'required|',
            'date'=>'required|date|',
            'lien_google_meet'=>'required|string',
            'theme'=>'required|string|max:255',
           
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([

            'succes'=>'false',
            'error'=>'true',
            'message'=>'erreur validation',
            'errorList'=>$validator->errors(),
        ]));
    }

    public function messages()
    {
        return [
           'mentor_id.required'=>'l\'id du mentor doit être fournit',

            'mentore_id.required'=>'l\'id du mentor doit être fournit',

            'date.required'=>'la date doit être fournit',
            'date.date'=>'la date doit être au format date',

            'lien_google_meet.required'=>'le lien_google_meet doit être fournit',
            'lien_google_meet.string'=>'le lien_google_meet doit être une chaîne de caractére',

            'theme.required'=>'le theme doit être fournit',
            'theme.string'=>'le lieu doit être une chaîne de caractére',
            'theme.max'=>'le nom ne doit dépasser 255 caractéres',

        ];
    }
}
