<?php

namespace App\Http\Requests\Perfil;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
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
            'password' => 'required|string|min:8',
            'newPassword' => 'required|string',
        ];
    }

    public function withValidator($validator){
        if(!$this->passwordConfirmed()){
            $validator->after(function ($validator){
                $validator->errors()->add('password', 'Confirme a senha correta');
            });
        }
    }

    private function passwordConfirmed(){
        $user = Auth::user();
        if (!Hash::check($this->password, $user->password)) {
            return false;
        }
        return true;
    }
}
