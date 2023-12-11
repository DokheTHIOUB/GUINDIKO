<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateMentorRequest extends FormRequest
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
            'nom'=>'required|string|max:65',
            'email'=>'required|string|email|unique:mentores',
            'numero_de_telephone' => 'required|string',
            'statut'=>'required|in:eleve,etudiant,professionnel,jeune_diplome',
            'password'=>'required|min:4'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response()->json([

            'succes'=>'false',
            'error'=>'true',
            'message'=>'Erreurr de validation',
            'errorList'=>$validator->errors(),
        ]));
    }

    public function messages()
    {
        return[
        'nom.required'=>'le nom doit être fourni',
        'nom.string'=>'le nom doit être une chaîne de caractére',
        'nom.max'=>'le nom ne doit dépasser 65 caractéres',

        'email.required'=>'l\'email doit être fourni',
        'email.string'=>'l\'email doit être une chaîne de caractére',
        'email.email' => 'L\'email doit être une adresse email valide',
        'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',

        'numero_de_telephone.required' => 'Le numéro de téléphone doit être fourni',
        'numero_de_telephone.string' => 'Le numéro de téléphone doit être une chaîne de caractères',

        'statut.required' => 'Le statut doit être fourni',
        'statut.in' => 'Le statut doit être l\'un des suivants : eleve, etudiant, professionnel, diplome',

        'password.required' => 'Le mot de passe doit être fourni',
        'password.min' => 'Le mot de passe doit comporter au moins 4 caractères',

        ];
    }
}
