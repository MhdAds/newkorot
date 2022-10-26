<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $appends = ['logo_full_path'];


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function logo()
    {
        return $this->images()->where('type', 'logo')->first();
    }

    public function getLogoPathAttribute()
    {
        if ($this->logo() != null) {
            return asset('storage' . 'service/' . $this->logo()->src);
        }
        return null;
    }
}
