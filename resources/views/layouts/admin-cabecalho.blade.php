<div class="row col-md-12  bg_menu" >
    <div clas="row">
        <nav>
            <ul class="nav nav-justified cabecalho">
                <li><img src="http://localhost/shopvel/public/image/logo_shopvel_admin.png" alt="logo shoppvel" style="height:90px;width:290px;"></li>
                <li class="active"><a href="{{url('admin/')}}">Home</a></li>
                <li><a href="{{route('admin.pedidos')}}">Pedidos</a></li>
                <li><a href="{{route('admin.listCategoria')}}">Categorias</a></li>
                <li><a href="{{route('admin.listProduto')}}">Produtos</a></li> 
                <li><a href="{{route('admin.listMarca')}}">Marcas</a></li>  
                <li><a href="{{route('admin.sobre')}}">Sobre</a></li>            

                @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                <li class="small">
                    <a href="{{route('admin.dashboard')}}">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <li>
                    <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                </li>
                @endif

            </ul>
        </nav>
    </div>

 <hr class="clearfix"/>
</div>