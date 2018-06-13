@extends('layouts.app')

@section('htmlheader_title')
	Solicitudes
@endsection

@section('main-content')
@if($solicitudes == 0)	
	<div class="panel panel-primary">
	    <div class="panel-heading">
	        Sistema rendición de fondos
	     </div>
		<div class="panel-body">
			<p><strong>
				* Estimado usuario usted no cuenta en  este momento con solicitudes para autorizar
			</strong>
			</p>
		</div>
	</div>
@endif

@if($rendiciones == "")	
	<div class="panel panel-primary">
	    <div class="panel-heading">
	        Sistema rendición de fondos
	     </div>
		<div class="panel-body">
			<p><strong>
				* Estimado usuario usted no cuenta en  este momento con rendiciones  para autorizar
			</strong>
			</p>
		</div>
	</div>
@endif
	
@endsection