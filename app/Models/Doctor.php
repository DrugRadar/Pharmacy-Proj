<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctor';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_image',
        'national_id',
        'pharmacy_id',
    ];
    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }
}