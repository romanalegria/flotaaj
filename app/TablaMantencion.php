<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TablaMantencion extends Model
{
     protected $table='tabla_mantenciones';

    protected $primaryKey='id';

    

    public $timestamps=false;

    protected $fillable =[
       	'nombre',
       	'k5000',
       	'k10000',
       	'k20000',
       	'k30000',
       	'k40000',
       	'k50000',
       	'k60000',
       	'k70000',
       	'k80000',
       	'k90000',
       	'k100000',
       	
    	
    ];
}
