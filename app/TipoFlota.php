<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoFlota extends Model
{
     protected $table='tipo_flota';

    protected $primaryKey='id';

    

    public $timestamps=false;


    protected $fillable =[
       	'nombre'   	
    	
    ];

    protected $guarded = [
    ];
}
