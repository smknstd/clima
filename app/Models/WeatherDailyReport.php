<?php

namespace App\Models;

use App\Models\Enums\WindDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class WeatherDailyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'weather_station_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'wind_direction' => WindDirection::class,
        'has_rain' => 'boolean',
        'has_storm' => 'boolean',
        'has_hail' => 'boolean',
        'has_snow' => 'boolean',
        'has_fog' => 'boolean',
        'has_flood' => 'boolean',
    ];

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
