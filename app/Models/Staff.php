<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class Staff extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $guard = 'web';

    protected $appends = ['avatar_full_path'];

    public const STATUS_DEACTIVATED = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_BLOCKED = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function avatar()
    {
        return $this->images()->orderBy('id', 'desc')->where('type', 'avatar')->first();
    }

    public function getAvatarFullPathAttribute()
    {
        if ($this->avatar() != null) {
            return asset('storage' . '/' . $this->avatar()->src);
        }
        return null;
    }
}
