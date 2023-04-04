<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory;
    protected $table = 'areas';
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'address',
        'country_id'
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
}
