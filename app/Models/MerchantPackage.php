<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantPackage extends Model
{
    use HasFactory;

    protected $appends = ['icon_full_path'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function icon()
    {
        return $this->images()->where('type', 'icon')->first();
    }

    public function getAvatarFullPathAttribute()
    {
        if ($this->icon() != null) {
            return asset('storage' .'/' . $this->icon()->src);
        }
        return null;
    }
}
