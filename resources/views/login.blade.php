<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema IAP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="css/signin.css" rel="stylesheet">
    <link href="img/iap.ico" rel="shortcut icon">
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/d4a766c662.js"></script>
</head>

<body>


    @auth
    <div class="container">
        <div class="d-flex justify-content-center mb-3">
            <img src="img/iap.png" style="width:300px;">
        </div>
        <div class="d-flex justify-content-center">
            <div class="alert alert-warning text-center" style="width: 500px" role="alert">
                <h3> Você ja fez login!</h3>
            </div>
        </div>
        <div class="text-center">
            <a class="btn btn-success" href="{{route('home')}}">Voltar</a>
        </div>
    </div>

    @else

    <main class="form-signin rounded shadow-lg text-center">
        @if ($mensagem = Session::get('erro'))
        <div class="alert alert-danger" role="alert">
            {{$mensagem}}
        </div>
        @endif

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
        <br>
        @endforeach
        @endif
        <form action="{{route('login.auth')}}" method="POST"><img class="mb-2" src="img/iap_login.png"
                style="width:300px">
            @csrf
            <div class="form-floating mb-1">
                <input type="email" class="form-control text-center" id="user" name="email" required>
                <label for="user">Login</label>
            </div>
            <div class="form-floating">
                <input class="form-control text-center" id="pass" name="password" required type="password">
                <label for="pass">Senha</label>
            </div>
            <input type="checkbox" name="remember" id="">Lembrar-me
            <button class="btn btn-lg btn-primary w-100 mt-1" type="submit"><i class="fa-sign-in-alt fas"></i>
            </button>
            <br><br>
            <a href="mailto:ti@iapat.com.br?subject=Redefinição de senha&body=Solicito redefinição de senha! Login:  / Senha:"
                target="_blank"><strong>Esqueci minha senha</strong></a>
            <p class="mb-3 mt-5 text-muted">© <a href="https://www.patologiaiap.com.br/site/" target="_blank"
                    rel="noopener noreferrer">IAP</a>
                <?php echo date("Y");?></p>
        </form>
    </main>

    @endauth


    <footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
    </footer>
</body>

</html>
