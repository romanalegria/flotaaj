<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
     protected $table='detalle_devoluciones';

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
       	'id_encargado',
    	'id_vehiculo',
    	'fecha_devolucion',
    	'fecha_sistema',
    	'descripcion',
    	'id_asignacion',
        'km_devolucion'
    	
    ];

    protected $guarded = [
    ];
}
