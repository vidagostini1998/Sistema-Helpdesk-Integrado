@extends('layout')
@section('title','Meu Perfil')

@section('main')
@if ($mensagem = Session::get('msg'))
<div class="text-center">
    <div class="d-flex justify-content-center">
        <div class="alert alert-success mt-2" role="alert" style="width: 300px">
            {{$mensagem}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
<div class="container border rounded shadow p-4">

    <form action="{{route('perfil.edit')}}" class="row g-2" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{auth()->user()->id}}">

        <div class="mb-2">
            <div class="text-center">
                @if (auth()->user()->foto_perfil == null)
                <img src="http://sistema-iap.test/img/default/profile.png" alt="" width="256"
                height="256" id="img_perfil" class=" rounded-circle">
                @else
                <img src="http://sistema-iap.test/img/profiles/{{auth()->user()->foto_perfil}}" alt="" width="256"
                height="256" id="img_perfil" class="rounded-circle">
                @endif
                <div class="mt-2">
                    <label for="formFileSm" class="form-label btn btn-warning"> Alterar Foto </label>
                    <input hidden class="form-control form-control-sm" id="formFileSm" name="img_perfil" type="file"
                        accept="image/*">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" name="nome" class="form-control" id="nome" value="{{auth()->user()->nome}}" required>
                <label for="nome" class="form-label">Nome</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="email" value="{{auth()->user()->email}}"
                    required>
                <label for="email" class="form-label">E-mail</label>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password">
                <label for="password" class="form-label">Alterar Senha</label>
            </div>
        </div>

        <div class="col text-center">
            <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom"
                data-bs-title="Salvar"><i class="fa-regular fa-floppy-disk fa-2xl"></i></button>
            <a href="{{url()->previous()}}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                data-bs-title="Voltar"><i class="fa-solid fa-left-long fa-2xl"></i></a>
        </div>
    </form>

</div>
@endsection
