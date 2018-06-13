<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
     protected $table='vehiculo';

    protected $primaryKey='id';

    protected $dateFormat = 'U';

    public $timestamps=false;


    protected $fillable =[
       	'nombres',
    	'marca',
    	'modelo',
    	'axo',
    	'tipovehiculo',
    	'estadovehiculo',
    	'tipocombustible',
    	'numserie',
    	'patente',
    	'color',
    	'areanegocio',
    	'encargado',
    	'empresa',
    	'kilometraje',
        'inspeccion',
        'mantencion',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5',
        'foto6',
        'foto7',
        'foto8',
        'foto9',
        'foto10',        

    ];

    protected $guarded = [
    ];

    //encargado
    public function encargado()
    {
        return $this->hasOne('App\Encargado');
    }

    
}
