<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class OrdenMenu extends Model
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="orden_menu";
    protected $fillable = [
        'num_orden',
        'nombre_submenu'
    ];

    public function menu()
    {
        return $this->hasMany('App\Menu');
    }

}
