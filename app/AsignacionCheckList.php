<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionCheckList extends Model
{
      protected $table='solicitudCheckList';

    protected $primaryKey='id';

    

    public $timestamps=false;

    protected $fillable =[
       	'fecha_creacion',
       	'id_usuario',
       	'id_vehiculo',
       	'observaciones',
       	'slu_estacionamiento',
       	'slu_bajas',
       	'slu_altas',
       	'slu_freno',
       	'slu_matras',
       	'slu_vderecha',
       	'slu_vizquierda',
       	'slu_patente',
       	'slu_tluz',

    	
    ];
}
