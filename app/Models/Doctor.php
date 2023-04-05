<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Cog\Laravel\Ban\Traits\Bannable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model implements BannableContract, HasMedia
{
    use HasFactory;
    use Bannable;
    use HasRoles, InteractsWithMedia ,SoftDeletes;
    protected $guard_name = 'doctor';
    protected $table = 'doctors';
    protected $morphClass = 'doctor';
    protected $dates = ['deleted_at'];

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

    public function user(){
        return $this->morphOne(User::class, 'userable');
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-m-Y'),
        );
    }

}