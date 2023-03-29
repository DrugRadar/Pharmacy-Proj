<?php

namespace App\Models;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Ban\Bannable as BannableContract;

class Doctor extends Model implements BannableContract
{
    use HasFactory;
    use Bannable;
    protected $table = 'doctor';
    protected $morphClass = 'doctor';

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
    public function user()
    {
       return $this->morphOne(User::class, 'userable');
    }
}