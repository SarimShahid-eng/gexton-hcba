<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Committee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'chairman_id',
        'chairman_id_id',
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
            'chairman_id' => 'integer',
            'chairman_id_id' => 'integer',
        ];
    }

    public function chairman(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function chairman(): BelongsTo
    {
        return $this->belongsTo(Chairman::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function elections(): HasMany
    {
        return $this->hasMany(Election::class);
    }
}
