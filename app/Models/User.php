<?php

namespace App\Models;

use App\Models\Enums\BlogpostType;
use App\Models\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'description',
        'website_url',
        'password',
        'role',
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
        'role' => UserRole::class,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function weatherStation(): HasOne
    {
        return $this->hasOne(WeatherStation::class, 'user_id');
    }

    public function avatar(): MorphOne
    {
        return $this->morphOne(Media::class, "model")
            ->where("model_key", "avatar");
    }

    public function isAdmin()
    {
        return $this->role === UserRole::ADMIN;
    }

    public function getAvatarThumbnail($size = 40)
    {
        if($this->avatar) {
            return $this->avatar->thumbnailFit($size, $size);
        }
        return asset('/img/default-avatar.jpg');
    }

    public function hasReview()
    {
        return Blogpost::where('published_at','<', now())
            ->where('type', BlogpostType::REVIEW)
            ->where('user_id', $this->id)
            ->exists();
    }

    public function getDefaultAttributesFor(string $attribute): array
    {
        return in_array($attribute, ["avatar"])
            ? ["model_key" => $attribute]
            : [];
    }
}
