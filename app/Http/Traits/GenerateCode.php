<?php

namespace App\Http\Traits;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait GenerateCode
{

    public function setCode()
    {
        if (config('app.env') === 'production') {
            $code = sprintf("%06d", mt_rand(1, 999999));
            // $code = '123456';
        }else{
            $code = '123456';
        }
        
        return $code;
    }
    
}