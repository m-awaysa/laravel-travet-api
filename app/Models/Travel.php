<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Travel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'travels';
    protected $fillable = [
        'name',
        'is_public',
        'slug',
        'description',
        'number_of_days'
    ];

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }

    public function numberOfNights(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['number_of_days'] - 1
        );
    }


}
