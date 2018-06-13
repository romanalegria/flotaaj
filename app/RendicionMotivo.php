<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RendicionMotivo extends Model
{
     protected $table='fnd_rendicion_motivo';
    
        protected $primaryKey='id';
    
        
    
        public $timestamps=false;
    
        protected $fillable =[
               'nrorendicion',
               'fecha',
               'idusuario',
               'idmotivo',
               'nombre_motivo',

        ];
}
