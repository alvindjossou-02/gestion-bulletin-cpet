<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApprenantRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasPermissionTo('gerer_apprenants');
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'matricule' => 'required|string|unique:apprenants,matricule|max:50',
            'sexe' => 'required|in:M,F',
            'date_naissance' => 'required|date|before:today',
            'lieu_naissance' => 'nullable|string|max:100',
            'filiere_id' => 'required|exists:filieres,id',
            'classe_id' => 'required|exists:classes,id',
            'reboublant' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est requis.',
            'prenom.required' => 'Le prénom est requis.',
            'matricule.required' => 'Le matricule est requis.',
            'matricule.unique' => 'Ce matricule existe déjà.',
            'sexe.required' => 'Le sexe est requis.',
            'date_naissance.required' => 'La date de naissance est requise.',
            'date_naissance.before' => 'La date de naissance doit être dans le passé.',
            'filiere_id.required' => 'La filière est requise.',
            'classe_id.required' => 'La classe est requise.',
        ];
    }
}
