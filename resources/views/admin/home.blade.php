@extends('layouts.admin')

@section('title', 'Inicio')

@section('links')
<link href="{{ asset('/admins/vendor/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-xl-6 col-12 mb-3"> 
						<div class="d-flex justify-content-start text-white card-left-radius border-solid border-width-5px border-grey"> 
							<div class="rounded-circle border-solid border-width-5px border-grey">
								<img src="{{ asset('/admins/img/logoadmin.png') }}" class="card-logo-rounded rounded-circle pt-1 px-1" alt="Logo">
							</div>
							<div class="card-logo-text py-2">
								<p class="h5 text-primary font-weight-bold pl-2">Bienvenido:</p>
								<p class="pl-2">Sistema Aministrativo de Ingresos || Electiva IV (Laravel)</p>
							</div>
						</div>
					</div>

					<div class="col-xl-6 col-12 mb-3">
						<div class="d-flex justify-content-start text-white card-left-radius border-solid border-width-5px border-grey"> 
							<div class="rounded-circle border-solid border-width-5px border-grey">
								<img src="{{ asset('/admins/img/icons/pacientes.png') }}" class="card-logo-rounded" alt="Noticias">
							</div>
							<div class="py-2 counter-card">
								<p class="h5 font-weight-bold pl-2">Proveedores</p>
								<p class="h3 font-weight-bold text-primary text-center pl-2">{{ $provider }}</p>
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
</div>


@endsection

@section('scripts')
<script src="{{ asset('/admins/js/dashboard/dash_1.js') }}"></script>
@endsection