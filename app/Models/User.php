<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_verified_seller',
        'total_co2_saved',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified_seller' => 'boolean',
            'total_co2_saved' => 'decimal:2',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Relationships
    public function items()
    {
        return $this->hasMany(Item::class, 'users_id');
    }

    public function buyerOrders()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    public function sellerOrders()
    {
        return $this->hasMany(Order::class, 'users_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'users_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'users_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'users_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(Item::class, 'favorites', 'users_id', 'item_id')->withTimestamps();
    }

    public function sellerVerification()
    {
        return $this->hasOne(SellerVerification::class, 'user_id');
    }
}
