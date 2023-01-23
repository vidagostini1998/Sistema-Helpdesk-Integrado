@extends('layout')
@section('title','Usuarios')
@push('scripts1')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endpush

@push('scripts2')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script src="{{ URL::asset('js/moment.js');}}"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.1/sorting/datetime-moment.js"></script>
<script src="{{ URL::asset('js/table.js');}}"></script>
<script src="{{ URL::asset('js/scripts.js');}}"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
@endpush
@section('main')
<div class="container-fluid">
    <h2 class="text-center">Usuarios</h2>
    <div class="text-center">
        <div data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Adicionar Usuario">
            <button class="btn btn-success" id="adc_user" data-bs-toggle="modal" data-bs-target="#adcModal"><i
                    class="fa-solid fa-plus"></i></button>
        </div>
        @if ($mensagem = Session::get('msg'))
        <div class="d-flex justify-content-center">
            <div class="alert alert-success mt-2" role="alert" style="width: 300px">
                {{$mensagem}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        @if ($mensagem = Session::get('erro'))
        <div class="d-flex justify-content-center">
            <div class="alert alert-danger mt-2" role="alert" style="width: 500px">
                {{$mensagem}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
    </div>
    <div class="table-responsive">
        <table class="styled-table text-center table-sm p-2" style="width: 100%" id="tableusuarios">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-Mail</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->nome}}</td>
                    <td>{{$user->email}}</td>

                    @if ($user->habilitado == '1')
                    <td>
                        <h5><span class="badge text-bg-success">Habilitado</span></h5>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-warning modal_edit_usuario" value="{{$user->id}}"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar Usuario"><i
                                class="fa-regular fa-pen-to-square"></i></button>
                        <a href="{{route('users.desabilitar',$user->id)}}" class="btn btn-danger"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Desabilitar Usuario"><i
                                class="fa-solid fa-xmark fa-xl"></i></a>
                        <button class="btn btn-info" id="modal_perm" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Permissões" value="{{$user->id}}"><i
                                class="fa-solid fa-user-check"></i></button>
                    </td>
                    @else
                    <td>
                        <h5><span class="badge text-bg-danger">Desabilitado</span></h5>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-warning modal_edit_usuario" value="{{$user->id}}"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar Usuario"><i
                                class="fa-regular fa-pen-to-square"></i></button>
                        <a href="{{route('users.habilitar',$user->id)}}" class="btn btn-success"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Habilitar Usuario"><i
                                class="fa-solid fa-check"></i></a>
                        <button class="btn btn-info" id="modal_perm" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Permissões" value="{{$user->id}}"><i
                                class="fa-solid fa-user-check"></i></button>
                    </td>
                    @endif

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Editar Usuario --}}
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('users.edit')}}" method="POST" id="form_edit" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-2">
                        <div class="text-center">
                            <img src="" alt="" width="128" height="128" id="img_perfil" class="rounded-circle">
                            <div class="mt-2">
                                <label for="formFileSm" class="form-label btn btn-warning"> Alterar Foto </label>
                                <input hidden class="form-control form-control-sm" id="formFileSm" name="img_perfil"
                                    type="file" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="text" name="nome" class="form-control" id="nome" required>
                            <label for="nome" class="form-label">Nome</label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control" id="email" required>
                            <label for="email" class="form-label">E-mail</label>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="password" required>
                            <label for="password" class="form-label">Alterar Senha</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
                <button type="button" class="btn btn-success" onclick="edit_user()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Adicionar Usuario --}}
<div class="modal fade" id="adcModal" tabindex="-1" aria-labelledby="adcModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('users.adc')}}" method="POST" id="form_adc">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="text" name="nome" class="form-control" id="nome" required>
                            <label for="nome" class="form-label">Nome</label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control" id="email" required>
                            <label for="email" class="form-label">E-mail</label>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="password" required>
                            <label for="password" class="form-label">Senha</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
                <button type="button" class="btn btn-success" onclick="adc_user()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Permissões --}}
<div class="modal fade" id="permModal" tabindex="-1" aria-labelledby="permModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Permissões</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="form_perm">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="hidden" name="id_perm" id="id_perm" value="">
                            <input type="text" value="" name="nome_perm" class="form-control" id="nome_perm" disabled>
                            <label for="nome" class="form-label">Nome</label>
                        </div>
                    </div>
                    <div class="border rounded p-2">
                        <h5 class="text-center">HelpDesk</h5>
                        <div class="form-check form-switch">
                            <input class="form-check-input switch" type="checkbox" role="switch" id="chamados">
                            <label class="form-check-label" for="chamados">Chamados/Pedidos</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input switch" type="checkbox" role="switch" id="manut">
                            <label class="form-check-label" for="manut">Manutenções</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input switch" type="checkbox" role="switch" id="cad">
                            <label class="form-check-label" for="cad">Cadastros</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input switch" type="checkbox" role="switch" id="rel">
                            <label class="form-check-label" for="rel">Relatorios</label>
                        </div>
                    </div>
                    <div class="border rounded p-2 mt-2">
                        <h5 class="text-center">Administração</h5>
                        <div class="form-check form-switch">
                            <input class="form-check-input switch" type="checkbox" role="switch" id="users">
                            <label class="form-check-label" for="users">Usuarios</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input switch" type="checkbox" role="switch" id="logs">
                            <label class="form-check-label" for="logs">Logs</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

@endsection
