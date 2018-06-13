<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidencia_Ssgg extends Model
{
    protected $table='incidencia_ssgg';

    protected $primaryKey='id';

    

    public $timestamps=false;


    protected $fillable =[
       	'sucursal',
       	'seviridad',
       	'asignado',
       	'resumen',
       	'descripcion',
       	'fecha_creacion',
       	'fecha_cierre',
        'observaciones',
    	
    ];
}
