<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasPermissionTo('saisir_notes');
    }

    public function rules()
    {
        return [
            'apprenant_id' => 'required|exists:apprenants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'note' => 'required|numeric|min:0|max:20',
            'type_evaluation' => 'required|in:Devoir,Interrogation',
        ];
    }

    public function messages()
    {
        return [
            'apprenant_id.required' => "L'apprenant est requis.",
            'apprenant_id.exists' => "L'apprenant sélectionné est invalide.",
            'matiere_id.required' => 'La matière est requise.',
            'matiere_id.exists' => 'La matière sélectionnée est invalide.',
            'note.required' => 'La note est requise.',
            'note.numeric' => 'La note doit être un nombre.',
            'note.min' => 'La note doit être au minimum 0.',
            'note.max' => 'La note ne peut pas dépasser 20.',
            'type_evaluation.required' => 'Le type d\'évaluation est requis.',
            'type_evaluation.in' => 'Le type d\'évaluation doit être "Devoir" ou "Interrogation".',
        ];
    }
}
