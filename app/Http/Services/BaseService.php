<?php

namespace App\Http\Services;
use Illuminate\Http\Request;

abstract class BaseService
{   
    /**
     * Abstract function to display records every service needs to define 
     * its definition
     * 
     * @param Illuminate\Http\Request $request
     */
    abstract public function getRecords(Request $request);
    
    public static function changeStatus($data)
    {
        dd($data);
    }
}