@extends('layouts.admin')

@section('title', 'Lista de Ingresos')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Lista de Ingresos</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						<div class="text-right">
							<a href="{{ route('income.create') }}" class="btn btn-primary">Agregar</a>
						</div>

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Fecha</th>
										<th>Proveedor</th>
										<th>Responsable</th>
										<th>Comprobante</th>
										<th>Total</th>
										<th>Estado</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach($incomes as $income)
									<tr>
										<td>{{ $num++ }}</td>
										<td>{{ $income->created_at }}</td>
										<td>{{ $income->provider->name." ".$income->provider->lastname }}</td>
										<td>{{ $income->vendedor->name." ".$income->vendedor->lastname }}</td>
										<td>{{ $income->vaucher }}</td>
										<td>{{ $income->total }}$</td>
										<td>{!! state($income->state) !!}</td>
										<td>
											<div class="btn-group" role="group">
												<button type="button" class="btn btn-danger btn-sm bs-tooltip modalDelete" data-url="{{ route('income.destroy',$income->id) }}" data-placement="bottom" title="Eliminar" data-codigo="{{ $income->vaucher }}" data-id="{{ $income->id }}"><i class="fa fa-trash"></i></button>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-bold" id="exampleModalLabel">ELIMINAR VENTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="form_delete">
        	@csrf
        	@method('DELETE')
        	<input type="hidden" name="id" id="id_venta">
        	<h2>¿Desea Borrar la venta <strong id="codigo_venta"></strong>?</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Si, Borrar la venta.</button>
       </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/jszip.min.js') }}"></script>    
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.print.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>

<script type="text/javascript">
	$(".modalDelete").click(function(event) {
		let id = $(this).data('id');
		    url = $(this).data('url');
		    codigo = $(this).data('codigo');  
		$("#form_delete").attr('action',url);
		$("#codigo_venta").text(codigo);
		$("#id_venta").val(id);
		$("#deleteModal").modal('show');
	});
</script>
@endsection