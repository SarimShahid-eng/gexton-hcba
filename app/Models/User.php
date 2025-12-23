<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'father_name',
        'date_of_birth',
        'gender',
        'cnic',
        'bar_license_number',
        'cnic_image',
        'fingerprint1',
        'fingerprint2',
        'fingerprint3',
        'fingerprint4',
        'face_data',
        'email',
        'phone',
        'password',
        'role_id',
        'is_verified_nadra',
        'is_verified_hcb',
        'status',
        'dues_paid',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'date_of_birth' => 'date',
            'role_id' => 'integer',
            'is_verified_nadra' => 'boolean',
            'is_verified_hcb' => 'boolean',
            'dues_paid' => 'boolean',
            'email_verified_at' => 'timestamp',
        ];
    }

    public function otps(): HasMany
    {
        return $this->hasMany(Otp::class);
    }

    public function nfcCards(): HasMany
    {
        return $this->hasMany(NfcCard::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function financialTransactions(): HasMany
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    public function welfareClaims(): HasMany
    {
        return $this->hasMany(WelfareClaim::class);
    }

    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    public function discountApplieds(): HasMany
    {
        return $this->hasMany(DiscountApplied::class);
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }

    public function complaintLogs(): HasMany
    {
        return $this->hasMany(ComplaintLog::class);
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class);
    }

    public function memberBalance(): HasOne
    {
        return $this->hasOne(MemberBalance::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
