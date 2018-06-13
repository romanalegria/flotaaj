<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rendicion extends Model
{
     protected $table='fnd_rendicion';

    protected $primaryKey='id';

 
  protected $dateFormat = 'U';



    public $timestamps=false;


    protected $fillable =[
       	'fecha_sistema',
    	'id_rendidor',
    	'tipo_documento',
    	'numero_documento',
    	'fecha_documento',
    	'monto_rendir',
        'id_solicitud',
    	'codigo_sap',
        'hora_rendicion',
        'proyecto',
        'nombreProyecto',
        'foto',
        'observaciones',
        'subconsumo',
        'id_zona',

    ];
}
