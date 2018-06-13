<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matriz extends Model
{
     protected $table='matriz';

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
       	'codigo',
    	'nombre'
    	
    ];

    protected $guarded = [
    ];
}
