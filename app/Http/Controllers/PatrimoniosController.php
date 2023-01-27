<?php

namespace App\Http\Controllers;

use App\Models\CategoriaPatrimonio;
use App\Models\Filial;
use App\Models\Local;
use App\Models\Patrimonios;
use App\Models\SituacaoPatrimonio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PatrimoniosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patrimonios = Patrimonios::all();
        $locals = Local::all(['id','nome_local']);
        $categorias = CategoriaPatrimonio::all(['id','nome_cate_patrimonio']);
        $filials = Filial::all(['id','nome_filial']);
        return view('cadastros/patrimonios/patrimonios', compact('patrimonios','locals','categorias','filials'));
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
        $patrimonio = $request->all();
        $patrimonio = Patrimonios::create($patrimonio);
        Log::notice('Adc Patrimonio',['Usuario'=>Auth::user()->nome,'ID Patrimonio Criado'=>$patrimonio->id,'IP'=>$request->ip()]);
        return redirect()->route('cadastros.patrimonios')->with('msg','Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patrimonios  $patrimonios
     * @return \Illuminate\Http\Response
     */
    public function show(Patrimonios $patrimonios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patrimonios  $patrimonios
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patrimonio = Patrimonios::findOrFail($id);
        $situacao = DB::table('situacao_patrimonios')->join('users','situacao_patrimonios.id_user','=','users.id')->where('id_patrimonio',$id)->select('situacao_patrimonios.*','users.nome')->get();
        return array($patrimonio,$situacao);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patrimonios  $patrimonios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $patrimonio = Patrimonios::findOrFail($id);
        $patrimonio->update([
            'patrimonio'=>$request->patrimonio,
            'nome'=>$request->nome,
            'marca'=>$request->marca,
            'modelo'=>$request->modelo,
            'n_serie'=>$request->n_serie,
            'fornecedor'=>$request->fornecedor,
            'ref'=>$request->ref,
            'obs_patrimonio'=>$request->obs_patrimonio,
            'situacao'=>$request->situacao,
            'motico_situacao'=>$request->motivo_situacao,
            'id_local'=>$request->id_local,
            'id_categoria'=>$request->id_categoria,
            'id_filial'=>$request->id_filial,
        ]);
        Log::notice('Editar Patrimonio',['Usuario'=>Auth::user()->nome,'ID Patrimonio Editado'=>$patrimonio->id,'IP'=>$request->ip()]);
        return redirect()->route('cadastros.patrimonios')->with('msg','Alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patrimonios  $patrimonios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patrimonios $patrimonios)
    {
        
    }
}
