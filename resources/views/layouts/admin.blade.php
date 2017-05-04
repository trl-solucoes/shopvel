<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Shoppvel</title>

        <!-- Bootstrap core CSS -->
        <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="{{asset('bootstrap/css/ie10-viewport-bug-workaround.css')}}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="justified-nav.css" rel="stylesheet">

        <link href="{{asset('css/default.css')}}" rel="stylesheet">

        <script src="{{asset('js/jquery-3.2.0.min.js')}}"></script>
        <script src="{{asset('js/dataTables/jquery.dataTables.js')}}"></script>
        <script src="{{asset('js/dataTables/dataTables.bootstrap.js')}}"></script>
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="{{asset('bootstrap/js/ie-emulation-modes-warning.js')}}"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">

            @include('layouts.admin-cabecalho')
            
            <!-- Example row of columns -->
            <div class="row normal">
                <div class="col-lg-2">
                    <h3>Administrador</h3>
                    <ul>
                        <li>
                            <a href="{{route('admin.dashboard')}}">
                                Painel de controle
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.pedidos')}}">
                                Todos os pedidos
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.pedidos', '?status=nao-pagos')}}">
                                Pedidos pendentes de pagamento
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.pedidos', '?status=pagos')}}">
                                Pedidos pagos
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.pedidos', '?status=finalizados')}}">
                                Pedidos finalizados
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.perfil')}}">
                                Perfil
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-10">
                    @include('layouts.messages')

                    @yield('conteudo')
                </div>
            </div>

            <!-- Site footer -->
            <footer class="footer">
                <p>&copy; 2016 Ademir Mazer Junior. @nunomazer - ademir.mazer.jr@gmail.com</p>
            </footer>

        </div> <!-- /container -->


        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="{{asset('bootstrap/assets/js/ie10-viewport-bug-workaround.js')}}"></script>
    </body>
</html>
<script>
    $(document).ready(function () {
       $('#dataTables-example').dataTable();
            });
    </script>
