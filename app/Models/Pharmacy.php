<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;
    protected $table = 'pharmacy';
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