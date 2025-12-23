<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'event_date',
        'status',
        'booker_id',
        'payment_status',
        'booker_id_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'event_date' => 'date',
            'booker_id' => 'integer',
            'booker_id_id' => 'integer',
        ];
    }

    public function booker(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function booker(): BelongsTo
    {
        return $this->belongsTo(Booker::class);
    }
}
