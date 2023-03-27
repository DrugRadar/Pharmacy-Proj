<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory;
    protected $table = 'area';
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'address',
    ];
}
