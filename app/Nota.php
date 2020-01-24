<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notes';

    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'content',
    ];
}
