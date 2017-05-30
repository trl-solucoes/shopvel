<div class="row col-md-12  bg_menu" >
    <div clas="row" >
        <a href="{{url('/')}}"></a>
        <nav >
            <ul class="nav nav-justified cabecalho " >
                <li>
                <span>
                    <a href="{{url('/')}}">
                        <img src="http://localhost/shopvel/public/image/logo_shopvel.png" alt="logo shoppvel" style="height:90px;width:290px;">
                    </a>
                </span>
                </li>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('sobre')}}">Sobre</a></li>            

                @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                <li class="small">
                    <a href="{{route('cliente.dashboard')}}">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <li>
                    <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                </li>
                @endif
                <li><a href="{{route('carrinho.listar')}}">Carrinho <span class="glyphicon glyphicon-shopping-cart"></span> </a></li>
            </ul>
        </nav>
        {!! Form::open(array('route' => 'produto.buscar', 'class'=>'navbar-form navbar-right')) !!} 
        <div class="form-group busca">
            {!! Form::input('text', 'termo-pesquisa', null,['placeholder'=>'O que vc procura?',
            'class'=>'form-control']) !!}
        </div>
        <button type="submit" class="btn btn-primary busca-btn">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </button>
        {!! Form::close() !!}
    </div>
    <hr class="clearfix"/>
</div>
