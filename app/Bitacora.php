<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table="bitacora";
    protected $fillable = [
        'ip', 'browser', 'nomuser','os'
    ];

}
