<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/administracao/users/perfil');
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
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $users = User::findOrFail($id);
        $path = public_path().'/img/profiles';
        
        if($request->password){

            $nameFile = "";
            if($request->hasFile('img_perfil') && $request->file('img_perfil')->isValid()){
                $name = uniqid(date('HisYmd'));
                $extension = $request->file('img_perfil')->extension();
                $nameFile = "{$name}.{$extension}";
                $request->file('img_perfil')->move($path,$nameFile);
                $pass = bcrypt($request->password);
                $users->update([
                'nome'=>$request->nome,
                'email'=>$request->email,
                'password'=> $pass,
                'foto_perfil'=> $nameFile,
            ]);
            Log::notice('Edit Meu Perfil',['Usuario'=>Auth::user()->nome,'ID Usuario Editado'=>$id,'IP'=>$request->ip()]);
            return redirect()->route('users.meu_perfil')->with('msg','Alterado com sucesso!');
            }
            else{
                $pass = bcrypt($request->password);
                $users->update([
                'nome'=>$request->nome,
                'email'=>$request->email,
                'password'=> $pass,
            ]);
            Log::notice('Edit Meu Perfil',['Usuario'=>Auth::user()->nome,'ID Usuario Editado'=>$id,'IP'=>$request->ip()]);
            return redirect()->route('users.meu_perfil')->with('msg','Alterado com sucesso!');
            }

            
        }
        else{
            $nameFile = "";
            if($request->hasFile('img_perfil') && $request->file('img_perfil')->isValid()){
                $name = uniqid(date('HisYmd'));
                $extension = $request->file('img_perfil')->extension();
                $nameFile = "{$name}.{$extension}";
                $request->file('img_perfil')->move($path,$nameFile);
                $users->update([
                    'nome'=>$request->nome,
                    'email'=>$request->email,
                    'foto_perfil'=> $nameFile,
                ]);
                Log::notice('Edit Meu Perfil',['Usuario'=>Auth::user()->nome,'ID Usuario Editado'=>$id,'IP'=>$request->ip()]);
                return redirect()->route('users.meu_perfil')->with('msg','Alterado com sucesso!');
            }
            else{
                $users->update([
                    'nome'=>$request->nome,
                    'email'=>$request->email,
                ]);
                Log::notice('Edit Meu Perfil',['Usuario'=>Auth::user()->nome,'ID Usuario Editado'=>$id,'IP'=>$request->ip()]);
                return redirect()->route('users.meu_perfil')->with('msg','Alterado com sucesso!');
            }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
