<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Pharmacy extends Model implements HasMedia

{
    use HasFactory;
    use HasRoles,  InteractsWithMedia,SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guard_name = 'pharmacy';
    protected $table = 'pharmacies';
    protected $morphClass = 'pharmacy';
    protected $guarded = [];


    protected $fillable = [
        'name',
        'email',
        'password',
        // 'avatar_image',
        'national_id',
        'area_id',
    ];
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}