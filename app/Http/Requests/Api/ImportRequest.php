<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\BaseRequest;
class ImportRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "entity" => "required|in:".implode(',',( array_keys(config('import.importers')))),
            "file" => "required|mimes:json",
        ];
    }

}
