<?php

namespace App\Services;

use App\Models\Country;

class CatsService
{
    public function test()
    {
        return 'Hello this is Cats Service';
    }
    
    public function get()
    {
        return Country::all();
    } 
}