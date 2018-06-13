<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='users';
    
        protected $primaryKey='id';
    
        protected $dateFormat = 'U';
    
        public $timestamps=false;
    
    
        protected $fillable =[
            'name',
            'email',
            'password',
            'idrol',
            'remember_token',
            'codigoSap',
            'Desvinculado',
            'fechaDesvinculacion',
            'montoPedio',
            'montoRendido',
            'montoMaximo',
            'idJefe',                       
        ];
    
        protected $guarded = [
        ];
    
        public function vehiculo()
        {
            return $this->hasOne('App\Vehiculo');
        }
}
