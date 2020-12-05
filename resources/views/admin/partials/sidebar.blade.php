<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="{{ asset('/admins/img/admins/'.Auth::user()->photo) }}" width="90" height="90" alt="logo">
                <h6 class="">Income</h6>
                <p class="">Sistema de Ingreso de Artículos</p>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ active('admin') }}">
                <a href="{{ route('admin') }}" aria-expanded="{{ menu_expanded('admin') }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span> Inicio</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/administradores', 0) }}">
                <a href="#admin" data-toggle="collapse" aria-expanded="{{ menu_expanded('admin/administradores', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-user-tie"></i> Administrador</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu('admin/administradores', 0) }} }}" id="admin" data-parent="#accordionExample">
                    <li {{ submenu('admin/administradores/Usuarios') }}>
                        <a href="{{ route('administradores.index') }}"> Usuarios</a>
                    </li>
                     
                    <li {{ submenu('admin/administradores/Clientes') }}>
                        <a href="{{ route('customer.index') }}"> Clientes</a>
                    </li>  
                                            
                </ul>
            </li>

            <li class="menu {{ active('admin/almacen', 0) }}">
                <a href="#almacen" data-toggle="collapse" aria-expanded="{{ menu_expanded('admin/almacen', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-building"></i> Almacén</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu('admin/almacen', 0) }} }}" id="almacen" data-parent="#accordionExample">
                    <li {{ submenu('admin/almacen/categorias') }}>
                        <a href="{{ route('category.index') }}"> Categorías</a>
                    </li>
                    <li {{ submenu('admin/almacen') }}>
                        <a href="{{ route('article.index') }}"> Artículos</a>
                    </li>                           
                </ul>
            </li>

             <li class="menu {{ active('admin/compras', 0) }}">
                <a href="#compras" data-toggle="collapse" aria-expanded="{{ menu_expanded('admin/compras', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-cart-plus"></i> Compras</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu('admin/compras', 0) }} }}" id="compras" data-parent="#accordionExample">
                    <li {{ submenu('admin/compras/proveedores') }}>
                        <a href="{{ route('provider.index') }}"> Proveedores</a>
                    </li>
                    <li {{ submenu('admin/compras') }}>
                        <a href="{{ route('income.index') }}"> Ingresos</a>
                    </li>                           
                </ul>
            </li>

           

        </ul>

    </nav>

</div>