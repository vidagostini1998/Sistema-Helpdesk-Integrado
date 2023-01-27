@extends('layout')
@section('title','Patrimonios')
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
    <h2 class="text-center">Patrimonios</h2>
    <div class="text-center">
        <div data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Adicionar Patrimonio">
            <button class="btn btn-success" id="adc_patrimonio" onclick="reset()" data-bs-toggle="modal"
                data-bs-target="#adcModal"><i class="fa-solid fa-plus"></i></button>
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
        <table class="styled-table text-center table-sm p-2 nowrap" style="width: 100%" id="tablepatrimonio">
            <thead>
                <tr>
                    <th>Patrimonio</th>
                    <th>Nome</th>
                    <th hidden>Marca</th>
                    <th>Modelo</th>
                    <th>Nº Serie</th>
                    <th hidden>Fornecedor</th>
                    <th>Ref</th>
                    <th hidden>Obs Patrimonio</th>
                    <th>Situação</th>
                    <th>Categoria</th>
                    <th>Filial</th>
                    <th>Local</th>
                    <th hidden>Adc. Por</th>
                    <th hidden>Data de Inclusão</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patrimonios as $patrimonio)
                <tr>
                    <td>{{$patrimonio->patrimonio}}</td>
                    <td>{{$patrimonio->nome}}</td>
                    <td hidden>{{$patrimonio->marca}}</td>
                    <td>{{$patrimonio->modelo}}</td>
                    <td>{{$patrimonio->n_serie}}</td>
                    <td hidden>{{$patrimonio->fornecedor}}</td>
                    <td>{{$patrimonio->ref}}</td>
                    <td hidden>{{$patrimonio->obs_patrimonio}}</td>
                    <td>{{$patrimonio->motivo_situacao}}</td>
                    <td>{{$patrimonio->categoria->nome_cate_patrimonio}}</td>
                    <td>{{$patrimonio->filial->nome_filial}}</td>
                    <td>{{$patrimonio->local->nome_local}}</td>
                    <td hidden>{{$patrimonio->user->nome}}</td>
                    <td hidden>{{$patrimonio->created_at}}</td>
                    <td>
                        <button class="btn btn-warning" id="modal_edit_patrimonio" value="{{$patrimonio->id}}"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar Patrimonio"><i
                                class="fa-regular fa-pen-to-square"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Adicionar Patrimonio --}}
<div class="modal fade modal-lg" id="adcModal" tabindex="-1" aria-labelledby="adcModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Patrimonio</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{route('patrimonio.adc')}}" method="POST" id="form_adc_patrimonio">
                    @csrf
                    <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" name="patrimonio" class="form-control" id="patrimonio" required>
                            <label for="patrimonio" class="form-label">Patrimonio</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="nome" class="form-control" id="nome" required>
                            <label for="nome" class="form-label">Nome</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" name="marca" class="form-control" id="marca">
                            <label for="marca" class="form-label">Marca</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" name="modelo" class="form-control" id="modelo">
                            <label for="modelo" class="form-label">Modelo</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" name="n_serie" class="form-control" id="n_serie">
                            <label for="n_serie" class="form-label">Nº Serie</label>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-floating">
                            <input type="text" name="fornecedor" class="form-control" id="fornecedor">
                            <label for="fornecedor" class="form-label">Fornecedor</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" style="height: 80px" name="ref" id="ref" cols="3"
                                rows="5"></textarea>
                            <label for="ref" class="form-label">Ref</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" style="height: 80px" name="obs_patrimonio"
                                id="obs_patrimonio" cols="3" rows="5"></textarea>
                            <label for="obs_patrimonio" class="form-label">OBS</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select name="manut_preventiva" id="manut_preventiva" class="form-select">
                                <option>Selecione</option>
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                            <label for="preventiva">Faz Preventiva?</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-floating">
                            <select class="form-select" id="categoria" name="id_categoria" aria-label="Categoria">
                                <option selected>Selecione</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nome_cate_patrimonio}}</option>
                                @endforeach
                            </select>
                            <label for="categoria">Categoria</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" id="local" name="id_local" aria-label="Local">
                                <option selected>Selecione</option>
                                @foreach ($locals as $local)
                                <option value="{{$local->id}}">{{$local->nome_local}}</option>
                                @endforeach
                            </select>
                            <label for="local">Local</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="filial" name="id_filial" aria-label="Filial">
                                <option selected>Selecione</option>
                                @foreach ($filials as $filial)
                                <option value="{{$filial->id}}">{{$filial->nome_filial}}</option>
                                @endforeach
                            </select>
                            <label for="filial">Filial</label>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
                <button type="button" class="btn btn-success" onclick="adc_patrimonio()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>


{{-- Modal Editar Patrimonio --}}
<div class="modal fade modal-lg" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Patrimonio</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{route('patrimonio.edit')}}" method="POST" id="form_edit_patrimonio">
                    @csrf
                    <input type="hidden" name="id" id="id_patri">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" name="patrimonio" class="form-control" id="patrimonio_patri" required>
                            <label for="patrimonio" class="form-label">Patrimonio</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="nome" class="form-control" id="nome_patri" required>
                            <label for="nome" class="form-label">Nome</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" name="marca" class="form-control" id="marca_patri">
                            <label for="marca" class="form-label">Marca</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" name="modelo" class="form-control" id="modelo_patri">
                            <label for="modelo" class="form-label">Modelo</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" name="n_serie" class="form-control" id="n_serie_patri">
                            <label for="n_serie" class="form-label">Nº Serie</label>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-floating">
                            <input type="text" name="fornecedor" class="form-control" id="fornecedor_patri">
                            <label for="fornecedor" class="form-label">Fornecedor</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" style="height: 80px" name="ref" id="ref_patri" cols="3"
                                rows="5"></textarea>
                            <label for="ref" class="form-label">Ref</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" style="height: 80px" name="obs_patrimonio"
                                id="obs_patrimonio_patri" cols="3" rows="5"></textarea>
                            <label for="obs_patrimonio" class="form-label">OBS</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="styled-table text-center p-2 w-100" id="table">
                                <thead>
                                    <tr>
                                        <th>Data Situação</th>
                                        <th>Motivo</th>
                                        <th>Adc. Por</th>
                                        <th data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Adicionar Situação"><button type="button" id="btn_situ" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#adcSituModal"><i class="fa-solid fa-plus"></i></button></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select id="preventiva" name="manut_preventiva" class="form-select" aria-label="Faz Preventiva?">
                                <option>Selecione</option>
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                            <label for="preventiva">Faz Preventiva?</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-floating">
                            <select class="form-select" id="categoria_patri" name="id_categoria" aria-label="Categoria">
                                <option>Selecione</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nome_cate_patrimonio}}</option>
                                @endforeach
                            </select>
                            <label for="categoria">Categoria</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" id="local_patri" name="id_local" aria-label="Local">
                                <option>Selecione</option>
                                @foreach ($locals as $local)
                                <option value="{{$local->id}}">{{$local->nome_local}}</option>
                                @endforeach
                            </select>
                            <label for="local">Local</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="filial_patri" name="id_filial" aria-label="Filial">
                                <option>Selecione</option>
                                @foreach ($filials as $filial)
                                <option value="{{$filial->id}}">{{$filial->nome_filial}}</option>
                                @endforeach
                            </select>
                            <label for="filial">Filial</label>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
                <button type="button" class="btn btn-success" onclick="edit_patrimonio()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Adc Situação --}}
<div class="modal fade modal-lg" id="adcSituModal" tabindex="-1" aria-labelledby="adcSituModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Situação</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{route('patrimonio.edit')}}" method="POST" id="form_adc_situacao">
                    @csrf
                    <input type="hidden" name="id_patrimonio" id="id_patrimonio">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input class="form-control" type="date" name="data_situacao" id="data_situacao">
                            <label for="data_situacao">Data</label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-floating">
                            <textarea class="form-control" name="motivo_situacao" id="motivo" style="height: 80px" cols="3" rows="5"></textarea>
                            <label for="motivo" class="form-label">Motivo Situação</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
                <button type="button" class="btn btn-success" onclick="edit_patrimonio()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

@endsection
