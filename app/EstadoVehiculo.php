<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoVehiculo extends Model
{
     protected $table='estado_vehiculo';

    protected $primaryKey='id';

    

    public $timestamps=false;


    protected $fillable =[
       	'nombre'   	
    	
    ];

    protected $guarded = [
    ];
}
