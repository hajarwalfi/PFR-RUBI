<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eligibility extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age_group',
        'weight_group',
        'recent_illness',
        'previous_donation',
        'medical_conditions',
        'is_eligible',
        'ineligibility_reason',
        'check_date'
    ];

    protected $casts = [
        'medical_conditions' => 'array',
        'check_date' => 'datetime',
        'is_eligible' => 'boolean'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
