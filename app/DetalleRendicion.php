<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleRendicion extends Model
{
    protected $table='fnd_rendicion_detalle';

    protected $primaryKey='id_rendicion';

 
     protected $dateFormat = 'U';



    public $timestamps=false;


    protected $fillable =[
       	'id_rendicion',
    	'fila',    	
        'codigoZona',
        'tipoDocumento',
        'numeroDocumento',
        'fechaDocumento',
        'codigoGasto',
        'codigoDetalle',
        'monto',
        'observaciones',
        'foto',

    ];

    public function CabezeraRendicion()
    {
    	return $this->hasOne('App\CabezeraRendicion','id_rendicion');
    }
}
