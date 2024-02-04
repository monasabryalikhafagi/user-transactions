<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\BaseRequest;
class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    
    public function rules()
    {
       
        return [
            "email" => "required|email",
            "password" => "required",
        ];
    }

}
