<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardMainCategory extends Model
{
    use HasFactory;

    public function card_categories()
    {
        return $this->hasMany(CardCategory::class, 'card_main_category_id');
    }
}
