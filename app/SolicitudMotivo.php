<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudMotivo extends Model
{
    protected $table='fnd_solicitud_motivo';
    
        protected $primaryKey='id';
    
        
    
        public $timestamps=false;
    
        protected $fillable =[
               'idSolicitud',
               'fechaSolicitud',
               'idUsuario',
               'nroSolicitud',
               'nombreMotivo',

        ];
}
