<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
     protected $table='documentacion_vehiculo';

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
       	'id_documento',
    	'id_vehiculo',
    	'fecha_vencimiento',
        'archivo',
        'poliza',
        'item',
    	
    ];

    protected $guarded = [
    ];
}
