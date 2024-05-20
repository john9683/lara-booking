<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * @return BelongsToMany
     */
    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class, 'hotel_manager_pivot')->using(HotelManagerPivot::class);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return optional($this->getRole)->name == 'admin';
    }

    /**
     * @return bool
     */
    public function isManager(): bool
    {
        return optional($this->getRole)->name == 'manager';
    }

    /**
     * Если метод называется role - он конфликтует с Voyager
     *
     * @return BelongsTo
     */
    public function getRole(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
