<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locals = Local::all();
        return view('cadastros/local/locals',compact('locals'));
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
        $local = $request->all();
        $local = Local::create($local);
        Log::notice('Adc Filial',['Usuario'=>Auth::user()->nome,'ID Filial Criada'=>$local->id,'IP'=>$request->ip()]);
        return redirect()->route('cadastros.local')->with('msg','Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function show(Local $local)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $local = Local::findOrFail($id);
        return $local;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $local = Local::findOrFail($id);
        $local->update([
            'nome_local'=>$request->nome_local,
        ]);
        Log::notice('Editar Local',['Usuario'=>Auth::user()->nome,'ID Local editado'=>$local->id,'IP'=>$request->ip()]);
        return redirect()->route('cadastros.local')->with('msg','Alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $local = Local::find($id);
        Log::notice('Del Local',['Usuario'=>Auth::user()->nome,'ID Local Deletado'=>$local->id,'Nome Local Deletado'=>$local->nome_filial,'IP'=>$request->ip()]);
        $local->delete();
        return redirect()->route('cadastros.local')->with('msg','Deletado com sucesso!');
    }
}
