<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Menu extends Model
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="menu";
    protected $primaryKey = 'menu_id';
    protected $fillable = [
        'nombre', 'url', 'orden_id','icono'
    ];

    public function ordenmenu()
    {
        return $this->hasMany('App\OrdenMenu');
    }
}
