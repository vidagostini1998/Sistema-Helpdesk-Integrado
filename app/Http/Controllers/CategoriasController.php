<?php

namespace App\Http\Controllers;

use App\Models\CategoriaInsumo;
use App\Models\CategoriaPatrimonio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate_patri = CategoriaPatrimonio::all();
        $cate_insu = CategoriaInsumo::all();
        return view('cadastros/categorias/categorias',compact('cate_patri','cate_insu'));
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
    public function storePatri(Request $request)
    {
        $patri = $request->all();
        $patri = CategoriaPatrimonio::create($patri);
        Log::notice('Adc Categoria Patrimonio',['Usuario'=>Auth::user()->nome,'ID Categoria Patrimonio Criada'=>$patri->id,'IP'=>$request->ip()]);
        return redirect()->route('cadastros.categorias')->with('msg','Adicionado com sucesso!');
    }

    public function storeInsu(Request $request)
    {
        $insu = $request->all();
        $insu = CategoriaInsumo::create($insu);
        Log::notice('Adc Categoria Insumo',['Usuario'=>Auth::user()->nome,'ID Categoria Insumo Criada'=>$insu->id,'IP'=>$request->ip()]);
        return redirect()->route('cadastros.categorias')->with('msg','Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPatrimonio($id)
    {
        $patri = CategoriaPatrimonio::findOrFail($id);
        return $patri;
    }

    public function editInsumo($id)
    {
        $insu = CategoriaInsumo::findOrFail($id);
        return $insu;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePatrimonio(Request $request)
    {
        $id = $request->id;
        $patri = CategoriaPatrimonio::findOrFail($id);
        $patri->update([
            'nome_cate_patrimonio'=>$request->nome_cate_patrimonio,
        ]);
        Log::notice('Editar Categoria Patrimonio',['Usuario'=>Auth::user()->nome,'ID Categoria Patrimonio Editada'=>$patri->id,'IP'=>$request->ip()]);
        return redirect()->route('cadastros.categorias')->with('msg','Alterado com sucesso!');
    }

    public function updateInsumo(Request $request)
    {
        $id = $request->id;
        $insu = CategoriaInsumo::findOrFail($id);
        $insu->update([
            'nome_cate_insumos'=>$request->nome_cate_insumos,
        ]);
        Log::notice('Editar Categoria Insumo',['Usuario'=>Auth::user()->nome,'ID Categoria Insumo Editada'=>$insu->id,'IP'=>$request->ip()]);
        return redirect()->route('cadastros.categorias')->with('msg','Alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPatrimonio($id,Request $request)
    {
        $patri = CategoriaPatrimonio::find($id);
        Log::notice('Del Categoria Patrimonio',['Usuario'=>Auth::user()->nome,'ID Categoria Patrimonio Deletada'=>$patri->id,'Nome Categoria Patrimonio Deletada'=>$patri->nome_filial,'IP'=>$request->ip()]);
        $patri->delete();
        return redirect()->route('cadastros.categorias')->with('msg','Deletado com sucesso!');
    }

    public function destroyInsumo($id,Request $request)
    {
        $insu = CategoriaInsumo::find($id);
        Log::notice('Del Categoria insumo',['Usuario'=>Auth::user()->nome,'ID Categoria Insumo Deletada'=>$insu->id,'Nome Categoria Insumo Deletada'=>$insu->nome_filial,'IP'=>$request->ip()]);
        $insu->delete();
        return redirect()->route('cadastros.categorias')->with('msg','Deletado com sucesso!');
    }
}
