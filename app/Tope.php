<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tope extends Model
{
     protected $table='fnd_tope_zona_gasto';

    protected $primaryKey='id';

    protected $dateFormat = 'U';

    public $timestamps=false;


    protected $fillable =[
       	'codigozona',
    	'concepto',
    	'subconcepto',
    	'tope',   	
    	
    ];

    protected $guarded = [
    ];

    public function vehiculo()
    {
        return $this->hasOne('App\Vehiculo');
    }
}
