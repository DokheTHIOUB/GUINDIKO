<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditArticleRequest extends FormRequest
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
            'libelle' => 'required',
            'description' => 'required',
            'debouche' => 'required',
            // 'image' => 'required|image',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException (response()->json([
            'success'=> false,
            'error'=> true,
            'message'=> 'erreur de validation',
            'errorLists' => $validator->errors(),
        ]));
    }

    public function messages()
    {
        return [
            'libelle.required'=>'le libelle doit être fourni',
            'decription.required'=>'la description doit être fourni',
            'debouche.required'=>'le debouche doit être fourni',
            'image.required'=>'l\'image doit être fourni',
            'image.image'=>'Seul les images sont autorisés',
            'image.max'=>'La taille de l\'image est trop grand 50mo max',
        ];
    }
}
