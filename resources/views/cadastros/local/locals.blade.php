@extends('layout')
@section('title','Locais')
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
    <h2 class="text-center">Locais</h2>
    <div class="text-center">
        <div data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Adicionar Filial">
            <button class="btn btn-success" id="adc_local" data-bs-toggle="modal" data-bs-target="#adcModal"><i
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
        <table class="styled-table text-center table-sm p-2" style="width: 100%" id="tablelocal">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th hidden>Adc. Por</th>
                    <th hidden>Data de Inclusão</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($locals as $local)
                <tr>
                    <td>{{$local->nome_local}}</td>
                    <td hidden>{{$local->user->nome}}</td>
                    <td hidden>{{$local->created_at}}</td>
                    <td>
                        <button class="btn btn-warning" id="modal_edit_local" value="{{$local->id}}"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar Local"><i
                                class="fa-regular fa-pen-to-square"></i></button>
                        <a href="{{route('local.del',$local->id)}}" class="btn btn-danger" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="Excluir Local"><i
                                class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Adicionar Filial --}}
<div class="modal fade" id="adcModal" tabindex="-1" aria-labelledby="adcModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Local</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('local.adc')}}" method="POST" id="form_adc">
                    @csrf
                    <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="text" name="nome_local" class="form-control" id="nome_filial" required>
                            <label for="nome" class="form-label">Nome</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
                <button type="button" class="btn btn-success" onclick="adc_local()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Editar Filial --}}
<div class="modal fade" id="localModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Local</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('local.edit')}}" method="POST" id="form_edit">
                    @csrf
                    <input type="hidden" name="id" id="id_local" value="">
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="text" name="nome_local" id="nome_local" class="form-control"
                                required>
                            <label for="nome" class="form-label">Nome</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
                <button type="button" class="btn btn-success" onclick="edit_local()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

@endsection
