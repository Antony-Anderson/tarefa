<?php

namespace App\Http\Requests\Tarefa;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable',
            'data' => 'required|date',
            'ativo' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'nome' => mb_convert_case($this->nome, MB_CASE_TITLE, "UTF-8")
        ]);
    }
}
