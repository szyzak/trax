<?php

namespace App\Modules\Cars\Models;

use App\Modules\Trips\Models\Trip;
use Database\Factories\CarFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $user_id
 */
class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'year', 'model', 'make'
    ];

    protected $casts = [
        'year' => 'int'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('owned_by_auth_user', function (Builder $builder) {
            $builder->where('user_id', '=', auth()->user()->id);
        });

        static::creating(function (self $item) {
            $item->user_id = auth()->user()->id;
        });
    }

    #region relations

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
        return CarFactory::new();
    }
}
