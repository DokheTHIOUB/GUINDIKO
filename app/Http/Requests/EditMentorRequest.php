<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditMentorRequest extends FormRequest
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
            'nom' => 'required',
            'email' => 'required|unique:users,email', 
            'password' => 'required', 
            'telephone' => 'required|regex:/^7[0-9]{8}$/|unique:mentors,telephone', 
            'specialite' => 'required', 
            'nombre_annee_experience' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'error' => true,
            'message' => 'erreur de validation',
            'errorList' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'nom.required' => 'le nom est requis',
            'email.required' => 'l\'email est requis',
            'email.unique' => 'l\'email existe déja',
            'password.required' => 'le mot de passe est requis',
            'specialite.required' => 'le nom est requis',
            'telephone.required' => 'le telephone est requis',
            'telephone.unique' => 'le numéro telephone est deja utilisé',
            'telephone.regex' => 'le format du numéro est incorrect',
            'nombre_annee_experience.required' => 'le nom est requis',
        ];
    }
}
