<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $table = 'stations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'type',
        'locality',
        'province',
        'latitude',
        'longitude',
        'height',
        'internal_id',
        'location',
        'from',
        'to'
    ];

//    public function company()
//    {
//        return $this->belongsto(Company::class, 'foreign_key');
//    }
//
//    public function invoice()
//    {
//        return $this->hasMany(Invoice::class);
//    }


}
