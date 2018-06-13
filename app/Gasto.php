<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
      protected $table='fnd_tipo_gasto';

    protected $primaryKey='id';

    

    public $timestamps=false;


    protected $fillable =[
       	'detalle'   	
    	
    ];

    protected $guarded = [
    ];
}
