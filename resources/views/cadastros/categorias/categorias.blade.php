@extends('layout')
@section('title','Categorias')
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
    <h2 class="text-center">Categorias</h2>
    <div class="text-center">
        <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Adicionar Categoria">
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" id="adc_filial" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa-solid fa-plus"></i></button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#adcModal" href="#">Categoria
                            Patrimonio</a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#adcModalInsumo"
                            href="#">Categoria Insumo</a></li>
                </ul>
            </div>
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

    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="catpatri-tab" data-bs-toggle="tab" data-bs-target="#catpatri-tab-pane"
                type="button" role="tab" aria-controls="catpatri-tab-pane" aria-selected="true">Categorias
                Patrimonio</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="catinsu-tab" data-bs-toggle="tab" data-bs-target="#catinsu-tab-pane"
                type="button" role="tab" aria-controls="catinsu-tab-pane" aria-selected="false">Categorias
                Insumos</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="catpatri-tab-pane" role="tabpanel" aria-labelledby="catpatri-tab"
            tabindex="0">
            <div class="table-responsive mt-4">
                <table class="styled-table text-center table-sm p-2" style="width: 100%" id="tablecatpatri">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th hidden>Adc. Por</th>
                            <th hidden>Data de Inclusão</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cate_patri as $patri)
                        <tr>
                            <td>{{$patri->nome_cate_patrimonio}}</td>
                            <td hidden>{{$patri->user->nome}}</td>
                            <td hidden>{{$patri->created_at}}</td>
                            <td>
                                <button class="btn btn-warning" id="modal_edit_cate_patri" value="{{$patri->id}}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar Categoria"><i
                                        class="fa-regular fa-pen-to-square"></i></button>
                                <a href="{{route('categorias.del.patri',$patri->id)}}" class="btn btn-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Excluir Categoria"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="catinsu-tab-pane" role="tabpanel" aria-labelledby="catinsu-tab" tabindex="0">
            <div class="table-responsive mt-4">
                <table class="styled-table text-center table-sm p-2" style="width: 100%" id="tablecatinsu">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th hidden>Adc. Por</th>
                            <th hidden>Data de Inclusão</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cate_insu as $insu)
                        <tr>
                            <td>{{$insu->nome_cate_insumos}}</td>
                            <td hidden>{{$insu->user->nome}}</td>
                            <td hidden>{{$insu->created_at}}</td>
                            <td>
                                <button class="btn btn-warning" id="modal_edit_cate_insu" value="{{$insu->id}}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar Categoria"><i
                                        class="fa-regular fa-pen-to-square"></i></button>
                                <a href="{{route('categorias.del.insu',$insu->id)}}" class="btn btn-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Excluir Categoria"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

{{-- Modal Adicionar Categoria Patrimonio --}}
<div class="modal fade" id="adcModal" tabindex="-1" aria-labelledby="adcModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Categoria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('categorias.adc.patri')}}" method="POST" id="form_adc_patri">
                    @csrf
                    <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="text" name="nome_cate_patrimonio" class="form-control"
                                id="nome_cate_patrimonio" required>
                            <label for="nome_cate_patrimonio" class="form-label">Nome</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
                <button type="button" class="btn btn-success" onclick="adc_cate_patri()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Adicionar Categoria Insumo --}}
<div class="modal fade" id="adcModalInsumo" tabindex="-1" aria-labelledby="adcModalLabelInsumo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Categoria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('categorias.adc.insu')}}" method="POST" id="form_adc_insu">
                    @csrf
                    <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="text" name="nome_cate_insumos" class="form-control" id="nome_cate_insumos"
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
                <button type="button" class="btn btn-success" onclick="adc_cate_insu()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Editar Categoria Patrimonio --}}
<div class="modal fade" id="categoriaPatrimonioModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Categoria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('categorias.edit.patri')}}" method="POST" id="form_edit_patri">
                    @csrf
                    <input type="hidden" name="id" id="id_cate_patri" value="">
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="text" name="nome_cate_patrimonio" id="nome_cate_patri" class="form-control"
                                value="" required>
                            <label for="nome" class="form-label">Nome</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
                <button type="button" class="btn btn-success" onclick="edit_cate_patri()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Editar Categoria Insumo --}}
<div class="modal fade" id="categoriaInsumoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Categoria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('categorias.edit.insu')}}" method="POST" id="form_edit_insu">
                    @csrf
                    <input type="hidden" name="id" id="id_cate_insu" value="">
                    <div class="mb-2">
                        <div class="form-floating">
                            <input type="text" name="nome_cate_insumos" id="nome_cate_insu" class="form-control"
                                value="" required>
                            <label for="nome" class="form-label">Nome</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-save" class="btn btn-danger" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sair"><i
                        class="fa-regular fa-circle-xmark fa-lg"></i></button>
                <button type="button" class="btn btn-success" onclick="edit_cate_insu()" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="Salvar"><i
                        class="fa-regular fa-floppy-disk fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

@endsection
