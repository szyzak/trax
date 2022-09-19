<?php

namespace App\Modules\Trips\Models;

use App\Modules\Cars\Models\Car;
use App\User;
use Database\Factories\TripFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $user_id
 */
class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'car_id', 'date', 'miles'
    ];

    protected $dates = ['date'];

    protected static function booted()
    {
        static::creating(function (self $item) {
            $item->user_id = auth()->user()->id;
        });
    }

    #region relations

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    #endregion relation

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TripFactory::new();
    }
}
