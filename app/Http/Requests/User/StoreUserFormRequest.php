<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|min:7|unique:users|email',
            'password' => 'required|min:4'
        ];
        $isUpdateRequest = $this->method() == 'PUT';
        //$id = $this->route($userId);
        if ($isUpdateRequest) {
            $rules = [
                //'email' => "filled|min:7|unique:users,email,{$id}",
            ];
        }
        
        return $rules;
    }
}
