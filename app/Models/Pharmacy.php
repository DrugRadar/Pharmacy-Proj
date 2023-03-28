<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Pharmacy extends Model
{
    use HasFactory;
    use HasRoles;
    protected $table = 'pharmacy';
    protected $guard_name = 'web';
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_image',
        'national_id',
        'area_id',
    ];
}