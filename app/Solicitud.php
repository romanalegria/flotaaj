<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table='fnd_solicitud';

    protected $primaryKey='id';

 
  protected $dateFormat = 'U';



    public $timestamps=false;


    protected $fillable =[
       	'fecha_solicitud',
    	'id_solicitante',
    	'monto_solicitado',
    	'proyecto',
    	'area',
    	'codigoSap',
        'coordinador',
    	'horaAutorizador1',
        'horaAutorizador2',
        'nombreProyecto',
    ];

  //Relación de muchos a uno

    public function user()
    {
        return $this->belongsTo('App\User', 'id_solicitante');
    }  
}
