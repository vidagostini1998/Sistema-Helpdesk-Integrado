@extends('layout')
@section('title','Manutenções')
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
    <h2 class="text-center">Manutenções</h2>
    <div class="text-center">
        <div data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Adicionar Manutenção">
            <button class="btn btn-success" id="adc_manut" data-bs-toggle="modal" data-bs-target="#adcModal"><i
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
    <ul class="nav nav-tabs nav-fill mt-3" id="myTab" role="tablist">
        @foreach ($filiais as $filial)
        @php
        $nome = str_replace("'","",$filial->nome_filial);
        @endphp
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="{{str_replace(' ','',$nome)}}-tab" data-bs-toggle="tab"
                data-bs-target="#{{str_replace(' ','',$nome)}}-tab-pane" type="button" role="tab"
                aria-controls="{{str_replace(' ','',$nome)}}-tab-pane"
                aria-selected="true">{{$filial->nome_filial}}</button>
        </li>
        @endforeach
    </ul>

    <div class="tab-content" id="myTabContent">
        @foreach ($filiais as $filial)
        @php

        $nome = str_replace("'","",$filial->nome_filial);
        @endphp
        <div class="tab-pane fade" id="{{str_replace(' ','',$nome)}}-tab-pane" role="tabpanel"
            aria-labelledby="{{str_replace(' ','',$nome)}}-tab" tabindex="0">
            <div class="table-responsive">
                <table class="styled-table text-center table-sm p-2" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Data Manut</th>
                            <th>Data Realizada</th>
                            <th hidden>Solicitante</th>
                            <th>Tipo Manut.</th>
                            <th>Motivo</th>
                            <th>Problema</th>
                            <th>Solução</th>
                            <th hidden>Obs</th>
                            <th>Status</th>
                            <th>Patrimonio</th>
                            <th hidden>Adc. Por</th>
                            <th hidden>Prestador</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($manuts as $manut)
                        @if ($manut->patrimonio->id_filial == $filial->id)
                        <tr>
                            <td>{{$manut->data_manutencao}}</td>
                            <td>{{$manut->data_realizada}}</td>
                            <td hidden>{{$manut->solicitante}}</td>
                            <td>{{$manut->tipo_manutencao}}</td>
                            <td>{{$manut->motivo}}</td>
                            <td>{{$manut->problema}}</td>
                            <td>{{$manut->solucao}}</td>
                            <td hidden>{{$manut->obs_manutencao}}</td>
                            <td>{{$manut->status_manutencao}}</td>
                            <td>{{$manut->patrimonio->patrimonio}}</td>
                            <td hidden>{{$manut->user->nome}}</td>
                            <td hidden>{{$manut->prestadores->nome_prestador}}</td>
                            <td><button type="button" class="btn btn-warning" id="edit_modal" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Editar Manutenção"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Excluir Manutenção"><i
                                        class="fa-solid fa-trash-can"></i></button></td>
                        </tr>
                        @endif

                        @endforeach


                    </tbody>
                </table>
            </div>

        </div>
        @endforeach
    </div>

</div>

{{-- Modal Adicionar Manutenção --}}
<div class="modal fade modal-lg" id="adcModal" tabindex="-1" aria-labelledby="adcModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Manutenção</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{route('patrimonio.adc')}}" method="POST" id="form_adc_patrimonio">
                    @csrf
                    <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="date" name="data_manutencao" class="form-control" id="data_manutencao">
                            <label for="data_manutencao" class="form-label">Data Manutenção</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="date" name="data_realizada" id="data_realizada" class="form-control">
                            <label for="data_realizada" class="form-label">Data Realizada</label>
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
@endsection
