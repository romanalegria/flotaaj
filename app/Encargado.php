<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
     protected $table='encargados';

    protected $primaryKey='id';

    protected $dateFormat = 'U';

    public $timestamps=false;


    protected $fillable =[
       	'rut',
    	'nombres',
    	'apellidos',
    	'telefono',
    	'licencia',
    	'Fecha_vencimiento'
    	
    ];

    protected $guarded = [
    ];

    public function vehiculo()
    {
        return $this->hasOne('App\Vehiculo');
    }
}
