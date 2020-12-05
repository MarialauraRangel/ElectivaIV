 @extends('layouts.admin')

 @section('title', 'Crear Artículo')

 @section('links')
 <link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
 <link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
 @endsection

 @section('content')

 <div class="row layout-top-spacing">

 	<div class="col-12 layout-spacing">
 		<div class="statbox widget box box-shadow">
 			<div class="widget-header">
 				<div class="row">
 					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
 						<h4>Crear Artículo</h4>
 					</div>                 
 				</div> 
 			</div>
 			<div class="widget-content widget-content-area">

 				<div class="row">
 					<div class="col-12">

 						@include('admin.partials.errors')

 						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
 						<form action="{{ route('article.store') }}" method="POST" class="form" id="formAdministrator" enctype="multipart/form-data">
 							@csrf
 							<div class="row">

 								<div class="form-group col-lg-6 col-md-6 col-12">
 									<label class="col-form-label">Foto (Opcional)</label>
 									<input type="file" name="photo" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" />
 								</div>

 								<div class="form-group col-lg-6 col-md-6 col-12">
 									<div class="row">
 										<div class="form-group col-lg-12 col-md-12 col-12">
 											<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
 											<input class="form-control" type="text" name="name" required placeholder="Nombre" value="{{ old('name') }}" id="name">
 										</div>

 										<div class="form-group col-lg-12 col-md-12 col-12">
 											<label class="col-form-label">Categoría<b class="text-danger">*</b></label>
 											<select  class="form-control " name="category_id" id="type_dni" required="">
 												<option>Seleccionar Categoria</option>
 												@foreach($categories as $c)
 												<option value="{{ $c->id}}">{{ $c->name }}</option>
 												@endforeach
 											</select>
 										</div>
 									</div> 
 								</div>


 								{{-- <div class="form-group col-lg-6 col-md-6 col-12">
 									<label class="col-form-label">Proveedor<b class="text-danger">*</b></label>
 									<select  class="form-control " name="provider_id" id="type_dni" required="">
 										<option>Seleccionar Proveedor</option>
 										@foreach($providers as $p)
 										<option value="{{ $p->id}}">{{ $p->name." ".$p->lastname }}</option>
 										@endforeach
 									</select>
 								</div> --}}

 								<div class="form-group col-lg-6 col-md-6 col-12">
 									<label class="col-form-label">Código<b class="text-danger">*</b></label>
 									<input class="form-control" type="text" name="cod" required placeholder="Código" value="{{ old('cod') }}" id="cod">
 								</div>

 								<div class="form-group col-lg-6 col-md-6 col-12">
 									<label class="col-form-label">Stock<b class="text-danger">*</b></label>
 									<input class="form-control" type="number" name="stock" required placeholder="Stock" value="{{ old('stock') }}" id="stock">
 								</div>

 								<div class="form-group col-lg-6 col-md-6 col-12">
 									<label class="col-form-label">Precio de Venta<b class="text-danger">*</b></label>
 									<input class="form-control" type="text" name="sale_price" required placeholder="Precio de Vneta" value="{{ old('sale_price') }}" id="sale_price">
 								</div>

 								<div class="form-group col-lg-6 col-md-6 col-12">
 									<label class="col-form-label">Precio de Compra<b class="text-danger">*</b></label>
 									<input class="form-control" type="text" name="purchase_price" required placeholder="Precio de Compra" value="{{ old('purchase_price') }}" id="purchase_price">
 								</div>

 								<div class="form-group col-lg-6 col-md-6 col-12">
 									<label class="col-form-label">Descripción<b class="text-danger">*</b></label>
 									<input class="form-control" name="description" required placeholder="Descripción" value="{{ old('description') }}" id="description">
 								</div>

 							</div>
 							<div class="form-group col-12">
 								<div class="btn-group" role="group">
 									<button type="submit" class="btn btn-primary" action="admin">Guardar</button>
 									<a href="{{ route('article.index') }}" class="btn btn-secondary">Volver</a>
 								</div>
 							</div> 
 						</div>
 					</form>
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
@endsection