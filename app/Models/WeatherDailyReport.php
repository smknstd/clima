<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class WeatherDailyReport extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    protected $dates = [
        'date',
    ];

    public function weatherStation(): BelongsTo
    {
        return $this->belongsTo(WeatherStation::class);
    }

    public function visuals(): MorphMany
    {
        return $this->morphMany(Media::class, "model")
            ->where("model_key", "visuals")
            ->orderBy("order");
    }

    public function getDefaultAttributesFor(string $attribute): array
    {
        return in_array($attribute, ["visuals"])
            ? ["model_key" => $attribute]
            : [];
    }
}
