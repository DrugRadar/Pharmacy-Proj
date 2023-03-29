<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Pharmacy extends Model
{
    use HasFactory;
    use HasRoles;
    protected $guard_name = 'pharmacy';
    protected $table = 'pharmacies';
    protected $morphClass = 'pharmacy';
    protected $guarded = [];


    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_image',
        'national_id',
        'area_id',
    ];
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}