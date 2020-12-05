@extends('layouts.admin')

@section('title', 'Registrar Ingreso de Artículos')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-5 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Registrar Ingreso de Artículos</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('income.store') }}" method="POST" class="form"id="formProduct" enctype="multipart/form-data">
							@csrf
							<div class="row">

								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Responsable<b class="text-danger">*</b></label>
									<input type="text" class="form-control"  value="{{ Auth::user()->name." ".Auth::user()->lastname }}" readonly="">
									<input type="hidden"  name="saler_id" value="{{ Auth::user()->id }}" >
								</div>

								<div class="form-group col-lg-5 col-md-5 col-12">
									<label class="col-form-label">N° Comprobante<b class="text-danger">*</b></label>
									<input type="text" class="form-control" name="vaucher"  value="{{ $codigo }}" readonly="">
									<input type="hidden"  name="cod" value="{{ Auth::user()->id }}" >
								</div>


								<div class="form-group col-lg-7 col-md-7 col-12">
									<label class="col-form-label">Proveedor<b class="text-danger">*</b></label>
									<select  class="form-control " name="provider_id" id="type_dni" required>
										<option>Seleccionar Proveedor</option>
										@foreach($providers as $p)
										<option value="{{ $p->id}}">{{ $p->name." ".$p->lastname }}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div id="content_product"></div>
							<div class="form-group col-md-12" id="content_product"></div>

							<div class="row">

								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label"><strong>Total</strong></label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-dollar (alias)"></i></div>
										<input type="number" class="form-control" id="total_venta" readonly="" name="total" required min="0" value="0">
										<input type="hidden"  id="total_venta_validation" name="neto">
										<input type="hidden" name="impuestos" id="neto_impuesto">
									</div>
								</div>
							</div>

							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" id="btn_success_venta" disabled="" action="product">Guardar Ingreso</button>
							</div>
						</form>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

	<div class="col-7 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Seleccione los productos</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						<div class="table-responsive">
							<table class="table table-hover table-export" >
								<thead>
									<tr>
										<th>#</th>
										<th>Foto</th>
										<th>Nombre</th>
										<th>Código</th>
										<th>Stock</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody id="content_cart_shopping">
									@foreach($articles as $article)
									<tr>
										<td>{{ $num++ }}</td>
										<td>
											<div class="d-flex">
												<div class="usr-img-frame mr-2 rounded-circle">
													<img src="{{ asset('/admins/img/articles/'.$article->photo) }}" class="rounded-circle mr-2" width="50" height="50" alt="{{ $article->name }}"> 
												</div>
											</div>
										</td>
										<td>{{ $article->name }}</td>
										<td>{{ $article->cod }}</td>
										<td>{!! stock($article->stock) !!}</td>
										<form action="" method="POST">
											@csrf
											<input type="hidden" name="id" id="id" value="{{ $article->id }}">
											<td><button type="button" class="btn btn-info add_product restore_button_{{ $article->id }}"
												data-descripcion="{{ $article->name }}"
												data-id="{{ $article->id }}"
												data-stock="{{ $article->stock }}"
												data-precio="{{ $article->sale_price }}">Agregar</button></td>
											</form>
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

	@endsection

	@section('scripts')
	<script src="{{ asset('/admins/vendor/dropify/dropify.min.js') }}"></script>
	<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
	<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
	<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
	<script src="{{ asset('/admins/js/validate.js') }}"></script>
	<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
	<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
	<script src="{{ asset('/admins/vendor/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('/admins/vendor/table/datatable/button-ext/jszip.min.js') }}"></script>    
	<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.print.min.js') }}"></script>

	<script type="text/javascript">

		$("#content_cart_shopping").on('click', '.add_product', function(event) {
			event.preventDefault();
			let producto = $(this);
			var idProducto = producto.data('id');
			let valor_total = $("#total_venta").val();
			var descripcion = producto.data('descripcion');
			var stock = producto.data('stock');

			var precio = parseFloat(producto.data('precio'));
			let porcentaje = $("#impuesto_valor").val();
			let impuesto_total = (precio * porcentaje / 100);
		// console.log(precio)
		// console.log(impuesto_total)
		let total = parseFloat(valor_total) + parseFloat(precio);


		producto.attr('disabled',true);

		//sumTotalProduct();
		sumTotalImpuesto();
		validateButtonDisabledAdd();

		$("#total_venta , #total_venta_validation").val(total);

		$("#content_product").append('<div class="row" style="background-color: #E5E5E5; padding-top: 1em;"><div class="form-group col-md-12">'+
			'<div class="input-group">'+
			'<div class="input-group-addon">'+
			'<button type="button" class="btn btn-danger btn-xs quitarProducto" data-precio="'+precio+'" data-id="'+idProducto+'"><i class="fa fa-times"></i></button>'+
			'</div>'+
			'<input type="text" class="form-control" name="descripcion[]" value="'+descripcion+'" readonly="">'+
			'<input type="hidden" name="article_id[]" value="'+idProducto+'">'+
			'</div>'+
			'</div>'+
			'<div class="form-group col-md-4">'+
			'<div class="input-group">'+
			'<input type="number" min="1" data-id="'+idProducto+'" data-stock="'+stock+'" data-precio="'+precio+'" value="1" class="form-control cantidad_product" name="quantity[]" >'+
			'</div>'+
			'</div>'+
			'<div class="form-group col-md-4">'+
			'<div class="input-group">'+
			'<div class="input-group-addon"><i class="fa fa-usd"></i></div>'+
			'<input type="text" class="form-control precioProduct" value="'+precio+'" id="precio_'+idProducto+'" name="sale_price[]" readonly="">'+
			'</div>'+
			'</div></div><hr>') 


	});

		$("#impuesto_valor").keydown(function(event) {
			
			sumTotalProduct();
			sumTotalImpuesto();


		});

		$("#content_product").on('click', '.quitarProducto', function(event) {
			event.preventDefault();

		$(this).parent('div').parent('div').parent('div').parent('div').remove(); //Remove field html

		sumTotalProduct();
		sumTotalImpuesto();
		validateButtonDisabled();

		$(".restore_button_"+$(this).data('id')).attr('disabled',false);
	});

		$("#content_product").on('change', '.cantidad_product', function(event) {
			event.preventDefault();
			let stock = $(this).data('stock');
			let precio = $(this).data('precio');
			let id = $(this).data('id');
			let value = $(this).val();
			let total_precio_individual = parseInt(value) * precio;

			$("#precio_"+id).val(total_precio_individual);

			sumTotalProduct();
			sumTotalImpuesto();

		//$("#total_venta").val(impuesto_total)
		// if (value > stock) {
		// 	alert("La cantidad supera el stock");
		// 	$(this).val(1);
		// 	return false;
		// }


	});

		function sumTotalProduct(arrNumber = [])
		{

			let total_venta = $("#total_venta");
			let total_venta_value = $("#total_venta").val();
			let total_venta_validation = $("#total_venta_validation");

			$(".precioProduct").each(function(index, el) {
				arrNumber.push($(this).val());
			});
			
			var sum = arrNumber.reduce((pv,cv)=>{
				return pv + (parseFloat(cv)||0);
			},0);

			total_venta.val(sum)
			total_venta_validation.val(sum)



		}

		function sumTotalImpuesto(arrNumber = [])
		{
			let total_venta = $("#total_venta");
			let total_venta_value = $("#total_venta").val();
			let impuesto =$("#impuesto_valor").val();
			let total_venta_validation = $("#total_venta_validation");

			$(".precioProduct").each(function(index, el) {
				arrNumber.push($(this).val());
			});

			var sum = arrNumber.reduce((pv,cv)=>{
				return pv + (parseFloat(cv)||0);
			},0);


			let total_mas_impuesto = (parseFloat(total_venta_validation.val()) * impuesto / 100);

			$("#neto_impuesto").val(total_mas_impuesto);

			total_venta.val(parseFloat(total_venta_validation.val()));

		}

		function validateButtonDisabled(arrNumber = [])
		{
			$(".precioProduct").each(function(index, el) {
				arrNumber.push($(this));
			});
			let total_array = arrNumber.length + 1
		//console.log()
		if(arrNumber.length <= 0)
		{
			$("#btn_success_venta").attr('disabled',true);
		}else{
			$("#btn_success_venta").attr('disabled',false);
		}
	}

	function validateButtonDisabledAdd(arrNumber = [])
	{
		$(".precioProduct").each(function(index, el) {
			arrNumber.push($(this));
		});
		let total_array = arrNumber.length + 1
		//console.log()
		if(total_array < 1)
		{
			$("#btn_success_venta").attr('disabled',true);
		}else{
			$("#btn_success_venta").attr('disabled',false);
		}
	}

</script>

@endsection

