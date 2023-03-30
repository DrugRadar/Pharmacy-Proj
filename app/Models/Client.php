<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

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
}