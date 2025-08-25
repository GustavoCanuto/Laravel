<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserReq extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "date_of_birth" => "nullable|date|before:today"
        ];
    }
}
