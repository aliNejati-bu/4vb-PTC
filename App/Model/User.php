<?php

namespace PTC\App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "user_email",
        "password",
        "phone",
        "user_type",
        "is_phone_verified",
        "is_email_verified",
        "is_super_admin"
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = !is_null($value) ? password_hash($value,PASSWORD_BCRYPT) : $this->password;
    }
    /**
     * @return HasMany
     */
    public function phoneCodes(): HasMany
    {
        return $this->hasMany(PhoneCode::class);
    }

    /**
     * @return HasMany
     */
    public function emailLinks(): HasMany
    {
        return $this->hasMany(EmailLink::class);
    }


    /**
     * @return HasMany
     */
    public function slugs(): HasMany
    {
        return $this->hasMany(Slug::class);
    }

    /**
     * @return HasMany
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }


    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }



}