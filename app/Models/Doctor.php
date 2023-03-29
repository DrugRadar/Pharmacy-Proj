<?php

namespace App\Models;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model implements BannableContract
{
    use HasFactory;
    use Bannable;
    use HasRoles;
    protected $guard_name = 'doctor';
    protected $table = 'doctors';

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