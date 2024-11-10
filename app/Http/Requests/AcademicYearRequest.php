<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcademicYearRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // À ajuster selon votre logique d'autorisation
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'start_year' => 'required|integer|min:2000',
            'end_year' => 'required|integer|gt:start_year',
            'is_active' => 'boolean',
            'trimesters' => 'required|array|min:1',
            'trimesters.*.name' => 'required|string|max:255',
            'trimesters.*.start_date' => [
                'required',
                'date',
                $this->trimesterDateRule('start'),
            ],
            'trimesters.*.end_date' => [
                'required',
                'date',
                'after:trimesters.*.start_date',
                $this->trimesterDateRule('end'),
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'start_year.required' => 'L\'année de début est requise.',
            'start_year.integer' => 'L\'année de début doit être un nombre entier.',
            'start_year.min' => 'L\'année de début doit être supérieure ou égale à 2000.',
            
            'end_year.required' => 'L\'année de fin est requise.',
            'end_year.integer' => 'L\'année de fin doit être un nombre entier.',
            'end_year.gt' => 'L\'année de fin doit être supérieure à l\'année de début.',
            
            'is_active.boolean' => 'Le statut actif doit être vrai ou faux.',
            
            'trimesters.required' => 'Au moins un trimestre est requis.',
            'trimesters.array' => 'Les trimestres doivent être fournis sous forme de liste.',
            'trimesters.min' => 'Au moins un trimestre est requis.',
            
            'trimesters.*.name.required' => 'Le nom du trimestre est requis.',
            'trimesters.*.name.string' => 'Le nom du trimestre doit être une chaîne de caractères.',
            'trimesters.*.name.max' => 'Le nom du trimestre ne peut pas dépasser 255 caractères.',
            
            'trimesters.*.start_date.required' => 'La date de début du trimestre est requise.',
            'trimesters.*.start_date.date' => 'La date de début doit être une date valide.',
            
            'trimesters.*.end_date.required' => 'La date de fin du trimestre est requise.',
            'trimesters.*.end_date.date' => 'La date de fin doit être une date valide.',
            'trimesters.*.end_date.after' => 'La date de fin doit être postérieure à la date de début.',
        ];
    }

    /**
     * Rule de validation pour les dates des trimestres.
     */
    private function trimesterDateRule(string $type): \Closure
    {
        return function ($attribute, $value, $fail) use ($type) {
            $startYear = $this->input('start_year');
            $endYear = $this->input('end_year');
            $date = date('Y', strtotime($value));
            
            if ($date < $startYear || $date > $endYear) {
                $message = $type === 'start' 
                    ? 'La date de début du trimestre doit être comprise dans l\'année académique.'
                    : 'La date de fin du trimestre doit être comprise dans l\'année académique.';
                $fail($message);
            }
        };
    }

    /**
     * Configure the validator instance before validation.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Vous pouvez ajouter ici des validations personnalisées supplémentaires
            // Par exemple, vérifier que les trimestres ne se chevauchent pas
        });
    }
}