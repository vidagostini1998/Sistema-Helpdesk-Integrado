<?php

namespace App\Http\Controllers;

use App\Models\Filial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FilialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filiais = Filial::all();
        return view('cadastros/filial/filiais', compact('filiais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filial = $request->all();
        $filial = Filial::create($filial);
        Log::notice('Adc Filial',['Usuario'=>Auth::user()->nome,'ID Filial Criada'=>$filial->id,'IP'=>$request->ip()]);
        return redirect()->route('cadastros.filial')->with('msg','Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filial  $filial
     * @return \Illuminate\Http\Response
     */
    public function show(Filial $filial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filial  $filial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filial = Filial::findOrFail($id);
        return $filial;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $filial = Filial::findOrFail($id);
        $filial->update([
            'nome_filial'=>$request->nome_filial,
        ]);
        Log::notice('Editar Filial',['Usuario'=>Auth::user()->nome,'ID Filial editada'=>$filial->id,'IP'=>$request->ip()]);
        return redirect()->route('cadastros.filial')->with('msg','Alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filial  $filial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $filial = Filial::find($id);
        Log::notice('Del Filial',['Usuario'=>Auth::user()->nome,'ID Filial Deletada'=>$filial->id,'Nome Filial Deletada'=>$filial->nome_filial,'IP'=>$request->ip()]);
        $filial->delete();
        return redirect()->route('cadastros.filial')->with('msg','Deletado com sucesso!');
    }
}
