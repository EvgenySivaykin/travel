<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    //вставка ниже:

    const SORT = [
        'asc_price' => 'Price 0-9',
        'desc_price' => 'Price 9-0',
    ];

    const PER_PAGE = [
        'all', 5, 12, 21, 34,
    ];

    // конец вставки

    public function hotelCountry()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function deletePhoto()
    {
        $fileName = $this->photo;
        if (file_exists(public_path().$fileName)) {
            unlink(public_path().$fileName);
        }
        $this->photo = null;
        $this->save();
    }
}