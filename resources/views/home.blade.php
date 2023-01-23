@extends('layout')

@section('title','Home')
@push('scripts2')
<script src="{{ URL::asset('js/time.js'); }}"></script>
@endpush

@section('main')
<div class="text-left border rounded shadow p-2 d-flex justify-content-between">
    <h3 >Bem vindo {{auth()->user()->nome}}</h3>
    <h3 id="time"></h3>
</div>
@endsection
