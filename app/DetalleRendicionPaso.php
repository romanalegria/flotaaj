<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleRendicionPaso extends Model
{
    protected $table='fnd_paso_rendicion';    

 
     protected $dateFormat = 'U';



    public $timestamps=false;


    protected $fillable =[
       	'codigoZona',
        'tipoDocumento',
        'numeroDocumento',
        'fechaDocumento',
        'codigoGasto',
        'codigoDetalle',
        'monto',
        'observaciones',
        'foto',
        'dias',

    ];

 }
