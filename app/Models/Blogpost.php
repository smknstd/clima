<?php

namespace App\Models;

use App\Models\Enums\BlogpostState;
use App\Models\Enums\BlogpostType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Tags\HasTags;

class Blogpost extends Model
{
    use HasFactory, HasTags;

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "state" => BlogpostState::class,
        "type" => BlogpostType::class,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
    ];

    public function isSinglePhoto(): bool
    {
        return $this->type === BlogpostType::SINGLE_PHOTO;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cover(): MorphOne
    {
        return $this->morphOne(Media::class, "model")
            ->where("model_key", "cover");
    }

    public function getDefaultAttributesFor(string $attribute): array
    {
        return in_array($attribute, ["cover"])
            ? ["model_key" => $attribute]
            : [];
    }
}
