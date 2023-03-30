<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Client extends Model implements MustVerifyEmail

{
    use HasFactory,Notifiable;

    protected $fillable = [
        "name",
        "email",
        "gender",
        "password",
        "date_of_birth",
        "national_id",
        "mobile_number",
        "avatar_image",
        "last_visit",
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    
    public function hasVerifiedEmail()
    {
        return ! is_null($this->email_verified_at);
    }

    public function markEmailAsVerified()
    {
        $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \Illuminate\Auth\Notifications\VerifyEmail);
    }

    public function getEmailForVerification()
    {
        return $this->email;
    }
}