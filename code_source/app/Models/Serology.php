<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serology extends Model
{
    use HasFactory;

    protected $fillable = [
        'tpha',
        'hb',
        'hc',
        'vih',
        'result',
        'donation_id',
    ];

    public function donation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Donation::class, 'donation_id');
    }

}
