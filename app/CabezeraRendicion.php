<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CabezeraRendicion extends Model
{
    protected $table='fnd_rendicion_cabecera';

    protected $primaryKey='id';

 
     protected $dateFormat = 'U';



    public $timestamps=false;


    protected $fillable =[
       	'fecha',
    	'usuario',    	
        'proyecto',
        'nombreProyecto',
        'nSolicitud',
        'totalRendido',       

    ];

    public function DetalleRendicion()
    {
    	return $this->hasMany('App\DetalleRendicion');
    }

    //Relación de muchos a uno

    public function usuario()
    {
        return $this->belongsTo('App\User', 'usuario');
    }
}
