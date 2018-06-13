<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
     protected $table='zonas';

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
       	'codigo',
    	'nombre'
    	
    ];

    protected $guarded = [
    ];
}
