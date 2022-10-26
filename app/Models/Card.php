<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;


    public function card_main_categories()
    {
        return $this->hasMany(CardMainCategory::class, 'company_id');
    }
}
