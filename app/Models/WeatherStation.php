<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeatherStation extends Model
{
    use HasFactory, SoftDeletes, SpatialTrait;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $spatialFields = [
        'city_geo_position',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function visuals(): MorphMany
    {
        return $this->morphMany(Media::class, "model")
            ->where("model_key", "visuals")
            ->orderBy("order");
    }

    public function getTitleBasedOnLocation() : string
    {
        return $this->city . " (" . $this->postal_code . ")";
    }

    public function getDefaultAttributesFor(string $attribute): array
    {
        return in_array($attribute, ["visuals"])
            ? ["model_key" => $attribute]
            : [];
    }
}
