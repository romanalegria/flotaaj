<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arriendo extends Model
{
    protected $table='detalle_arriendos';

    protected $primaryKey='id';

    protected $dateFormat = 'U';

    public $timestamps=false;


    protected $fillable =[
       	'id_solicitante',
    	'fecha',
    	'proyecto',
    	'valorCancelado',
    	'patente',
    	'marca',
    	'modelo',
    	'axo',
    	'color',
    	'color',
    	'factura',
    	'observaciones',
    	
    ];

    protected $guarded = [
    ];

    //Relacion con usuario
    public function User() 
    {
        return $this->hasOne('App\User','id');
    }
}
