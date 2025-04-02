<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'identifier',
        'date',
        'type',
        'location',
        'quantity',
        'operator',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function serology(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Serology::class, 'donation_id');
    }
    public function observations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Observation::class);
    }
}
