<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as CoreAuthenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements CoreAuthenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phone_number',
        'package',
        'email',
        'password',
        'password_view',
        'isActive'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'isActive' => 'boolean'
        ];
    }

    public function transfer_details()
    {
        return $this->hasMany(UserTransferDetail::class);
    }

    public function kyc()
    {
        return $this->hasOne(UserKyc::class);
    }

    public function getKycStatus()
    {
        $status = 'pending';
        if ($this->kyc) {
            $status = $this->kyc->status;
        }
        if (
            !$this->profile_photo_path || !$this->date_of_birth || !$this->gender || !$this->timezone || !$this->address
            || !$this->pincode || !$this->city || !$this->state
            || !$this->country
        ) {
            $status = 'pending';
        }
        if ($this->kyc && $this->kyc->status == 'rejected') {
            $status = 'rejected';
        }
        return $status;
    }
    public function getStatusAttribute()
    {
        return $this->getKycStatus();;
    }
    public function getKycStatusBadgeData()
    {
        $status = $this->getKycStatus();
        $class = 'badge-warning';
        if ($status == 'approved') {
            $class = 'badge-success';
        }
        if ($status == 'rejected') {
            $class = 'badge-error';
        }
        return [
            'value' => ucfirst($status),
            'class' => $class,
        ];
    }

    public function pendingPlanRequests(): HasMany
    {
        return $this->hasMany(UserPlanRequest::class)->where('status', 'pending');
    }
    public function deposits(): HasMany
    {
        return $this->hasMany(UserDeposit::class)->orderBy('id', 'desc');
    }
    public function withdrawls(): HasMany
    {
        return $this->hasMany(UserWithdrawl::class)->orderBy('id', 'desc');
    }
    public function getIsIBPartnerAttribute(): bool
    {
        return IbPartnerRequest::where('user_id', $this->id)->where('status', 'approved')->first() ? true : false;
    }
    public function ib_partnet_request(): HasOne
    {
        return $this->hasOne(IbPartnerRequest::class);
    }
}
