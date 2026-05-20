<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvaluosApiRequest extends FormRequest
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
            'localidad' => 'required',
            'oficina' => 'required',
            'tipo_predio' => 'required',
            'numero_registro_inicial' => 'required',
            'numero_registro_final' => 'required',
        ];
    }
}
