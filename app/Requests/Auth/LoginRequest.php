<?php
namespace App\Requests\Auth;

use App\Requests\Request;

class LoginRequest extends Request
{
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string'
        ];
    }
}