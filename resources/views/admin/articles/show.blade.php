 @extends('layouts.admin')

@section('title', 'Perfil del Artículo')

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="col-xl-5 col-lg-7 col-md-4 col-sm-12 layout-top-spacing">

	<div class="user-profile layout-spacing">
		<div class="widget-content widget-content-area">
			<div class="d-flex justify-content-between">
				<h3 class="">Datos del Articulo</h3>
				<a href="{{ route('article.edit', ['slug' => $article->slug]) }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
			</div>
			<div class="text-center user-info">
				<img src="{{ asset('/admins/img/articles/'.$article->photo) }}" width="90" height="90" alt="Foto de perfil">
				<p class="">{{ $article->name }}</p>
			</div>
			<div class="user-info-list">

				<div class="">
					<ul class="contacts-block list-unstyled">
						<li class="contacts-block__item">
							Categoria -> 
							{{ $article->category->name }}
						</li>
						<li class="contacts-block__item">
							Proveedor ->
							{{ $article->provider->name." ".$article->provider->lastname }} 
						</li>
						<li class="contacts-block__item">
							Código ->
							{{ $article->cod }}</a>
						</li>
						<li class="contacts-block__item">
							Stock ->
							{{ $article->stock }}
						</li>
						<li class="contacts-block__item">
							Precio de Venta ->
							{{ $article->sale_price }}
						</li>
						<li class="contacts-block__item">
							Precio de Compra ->
							{{ $article->purchase_price }}
						</li>
						<li class="contacts-block__item">
							Descripción ->
							{{ $article->description }}
						</li>
					</ul>
				</div>                                    
			</div>
		</div>
	</div>
</div>

@endsection