<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $studentId = $this->route('etudiant');

        return [
            'nom' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\s\-]+$/',
            'prenom' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\s\-]+$/',
            'date_naissance' => 'required|date|before:today|after:2000-01-01',
            'email' => 'required|email|max:255|unique:students,email,' . $studentId,
            'phone' => 'required|string|regex:/^[\+]?[0-9\-\(\)\s]+$/|max:20',
            'sexe' => 'required|in:M,F,Homme,Femme',
            'address' => 'required|string|max:500',
            'parent_id' => 'required|exists:parents,id',
            'relation' => 'required|in:mere,pere,frere,soeur,tuteur',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nom.regex' => 'Le nom ne doit contenir que des lettres.',
            'prenom.regex' => 'Le prénom ne doit contenir que des lettres.',
            'phone.regex' => 'Le format du numéro de téléphone est invalide.',
            'email.unique' => 'Cet email est déjà utilisé.',
        ];
    }
}
