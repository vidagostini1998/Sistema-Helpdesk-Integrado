<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ URL::asset('img/iap.ico'); }}" rel="shortcut icon">
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/d4a766c662.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/font.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('css/header_home.css'); }}">
    @stack('scripts1')
</head>

<body>
    <div class="container-fluid home">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <button type="button" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 btn" data-bs-toggle="offcanvas"
                data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                <i class="fa-solid fa-bars fa-2xl" style="color: white"></i>
            </button>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">

                <a href="/home"><img src="{{ URL::asset('img/iap.png'); }}" style="width: 125px" alt=""></a>
            </ul>

            <div class="col-md-3 text-end">
                <a href="{{route('login.logout')}}" class="btn btn-danger">Logout</a>
            </div>
        </header>
    </div>

    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header mb-0 pb-0">
            <h5 class="offcanvas-title" id="staticBackdropLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="flex-shrink-0 p-0 bg-white">
                <ul class="list-unstyled ps-0">
                    <li class="mb-1 text-center">
                        <a href="{{route('users.meu_perfil')}}"
                            class="btn d-inline-flex align-items-center rounded border-0 collapsed"
                            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Ver Perfil">
                            @if (auth()->user()->foto_perfil == null)
                            <img src="{{ URL::asset('img/default/profile.jpg'); }}" alt="" width="64" height="64"
                                id="img_perfil" class=" rounded-circle">
                            @else
                            
                            <img src="{{ URL::asset('img/profiles/'. auth()->user()->foto_perfil.''); }}" alt=""
                                width="64" height="64" id="img_perfil" class="rounded-circle">
                            @endif
                        </a>

                    </li>
                    <li class="border-bottom my-1"></li>
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                            data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                            HelpDesk
                        </button>
                        <div class="collapse" id="home-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="#"
                                        class="link-dark d-inline-flex text-decoration-none rounded">Chamados/Pedidos</a>
                                </li>
                                <li><a href="#"
                                        class="link-dark d-inline-flex text-decoration-none rounded">Manutenções</a>
                                </li>
                                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded"
                                        data-bs-toggle="collapse" data-bs-target="#collapsecadastro"
                                        aria-expanded="false" aria-controls="collapsecadastro">Cadastros</a>
                                    <div class="collapse" id="collapsecadastro">
                                        <ul class="list-unstyled fw-normal pb-1 ms-3">
                                            <li>
                                                <a href="{{route('cadastros.filial')}}"
                                                    class="link-dark d-inline-flex text-decoration-none rounded">Filiais</a>
                                            </li>
                                            <li>
                                                <a href="{{route('cadastros.local')}}"
                                                    class="link-dark d-inline-flex text-decoration-none rounded">Locais</a>
                                            </li>
                                            <li>
                                                <a href="{{route('cadastros.categorias')}}"
                                                    class="link-dark d-inline-flex text-decoration-none rounded">Categorias</a>
                                            </li>
                                            <li>
                                                <a href="{{route('cadastros.patrimonios')}}"
                                                    class="link-dark d-inline-flex text-decoration-none rounded">Patrimonios</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#"
                                        class="link-dark d-inline-flex text-decoration-none rounded">Relatorios</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                            data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                            Orders
                        </button>
                        <div class="collapse" id="orders-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a>
                                </li>
                                <li><a href="#"
                                        class="link-dark d-inline-flex text-decoration-none rounded">Processed</a>
                                </li>
                                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a>
                                </li>
                                <li><a href="#"
                                        class="link-dark d-inline-flex text-decoration-none rounded">Returned</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <a href="http://192.168.0.206:3000" target="_blank"
                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed">WhatsApp</a>
                    </li>
                    <li class="border-bottom my-1"></li>
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                            data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                            Administração
                        </button>
                        <div class="collapse" id="dashboard-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{route('adm.users')}}"
                                        class="link-dark d-inline-flex text-decoration-none rounded"><i
                                            class="fa-solid fa-users me-1"></i>Usuarios</a>
                                </li>
                                <li><a href="/logs" target="_blank"
                                        class="link-dark d-inline-flex text-decoration-none rounded"><i
                                            class="fa-solid fa-book me-1"></i>Log</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    @yield('main')
    <footer>
        <br><br><br> <br>
        <div class="d-flex justify-content-center fixed-bottom home">
            <a href="" class="my-2 my-lg-0">
                <img class="" src="{{ URL::asset('img/iap.png'); }}" alt="" style="width: 80px;">
            </a>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
        <script src="{{ URL::asset('js/tooltips.js'); }}"></script>
        @stack('scripts2')

    </footer>
</body>

</html>
