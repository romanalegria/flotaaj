<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mnt_flotaaj extends Model
{
    protected $table='mnt_flotaaj';

    protected $primaryKey='id';

 
  protected $dateFormat = 'U';



    public $timestamps=false;


    protected $fillable =[
       	'id',
       	'fecha',
    	'km_vehiculo',
    	'km_aplicar',
    	'trabajos',
    	'patente',    	

    ];
}
