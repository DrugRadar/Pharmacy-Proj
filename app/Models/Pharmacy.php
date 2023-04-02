<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Pharmacy extends Model implements HasMedia

{
    use HasFactory;
    use HasRoles,  InteractsWithMedia;

    protected $guard_name = 'pharmacy';
    protected $table = 'pharmacies';
    protected $morphClass = 'pharmacy';
    protected $guarded = [];


    protected $fillable = [
        'name',
        'email',
        'password',
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