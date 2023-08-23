<?php

namespace App\Requests\Users;

use App\Requests\BaseRequestFormApi;

class CreateUserRequest extends BaseRequestFormApi
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'=>'required' ,
            'name'=>'required' ,
            'password'=>'required' ,
        ];
    }
}
