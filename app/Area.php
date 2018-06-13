<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
     protected $table='areas';

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
       	'codigo',
    	'nombre'
    	
    ];

    protected $guarded = [
    ];
}
