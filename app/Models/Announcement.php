<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
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
        'title',
        'content',
        'posted_by',
        'posted_at',
        'posted_by_id',
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
            'posted_by' => 'integer',
            'posted_at' => 'timestamp',
            'posted_by_id' => 'integer',
        ];
    }

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(PostedBy::class);
    }
}
