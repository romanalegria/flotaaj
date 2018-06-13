<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
     protected $table='detalle_asignaciones';

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
       	'id_encargado',
    	'id_vehiculo',
    	'fecha_asignacion',
    	'fecha_sistema',
    	'descripcion',
        'km_entrega'
    	
    ];

    protected $guarded = [
    ];
}
