<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table='tipo_documento';

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
       	'codigo',
    	'nombre'
    	'archivo'
    ];

    protected $guarded = [
    ];
}
