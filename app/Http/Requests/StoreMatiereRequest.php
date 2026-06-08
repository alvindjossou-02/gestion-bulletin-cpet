<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatiereRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasPermissionTo('gerer_classes_filieres');
    }

    public function rules()
    {
        return [
            'nom_matiere' => 'required|string|max:100',
            'coefficient' => 'required|numeric|min:0.5|max:5',
            'filiere_id' => 'required|exists:filieres,id',
            'classe_id' => 'nullable|exists:classes,id',
        ];
    }

    public function messages()
    {
        return [
            'nom_matiere.required' => 'Le nom de la matière est requis.',
            'coefficient.required' => 'Le coefficient est requis.',
            'coefficient.numeric' => 'Le coefficient doit être un nombre.',
            'coefficient.min' => 'Le coefficient doit être au moins 0.5.',
            'coefficient.max' => 'Le coefficient ne peut pas dépasser 5.',
            'filiere_id.required' => 'La filière est requise.',
            'filiere_id.exists' => 'La filière sélectionnée est invalide.',
            'classe_id.exists' => 'La classe sélectionnée est invalide.',
        ];
    }
}
