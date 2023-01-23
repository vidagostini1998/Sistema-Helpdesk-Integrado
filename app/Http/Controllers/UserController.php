<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('administracao/users/users', compact('users'));
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
        $user = $request->all();
        $user['password'] = bcrypt($request->password);
        $user = User::create($user);
        Log::notice('Adc Usuario',['Usuario'=>Auth::user()->nome,'ID Usuario Criado'=>$user->id,'IP'=>$request->ip()]);
        return redirect()->route('adm.users')->with('msg','Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
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
            Log::notice('Edit Usuario',['Usuario'=>Auth::user()->nome,'ID Usuario Editado'=>$id,'IP'=>$request->ip()]);
            return redirect()->route('adm.users')->with('msg','Alterado com sucesso!');
            }
            else{
                $pass = bcrypt($request->password);
                $users->update([
                'nome'=>$request->nome,
                'email'=>$request->email,
                'password'=> $pass,
            ]);
            Log::notice('Edit Usuario',['Usuario'=>Auth::user()->nome,'ID Usuario Editado'=>$id,'IP'=>$request->ip()]);
            return redirect()->route('adm.users')->with('msg','Alterado com sucesso!');
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
                Log::notice('Edit Usuario',['Usuario'=>Auth::user()->nome,'ID Usuario Editado'=>$id,'IP'=>$request->ip()]);
                return redirect()->route('adm.users')->with('msg','Alterado com sucesso!');
            }
            else{
                $users->update([
                    'nome'=>$request->nome,
                    'email'=>$request->email,
                ]);
                Log::notice('Edit Usuario',['Usuario'=>Auth::user()->nome,'ID Usuario Editado'=>$id,'IP'=>$request->ip()]);
                return redirect()->route('adm.users')->with('msg','Alterado com sucesso!');
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
        
    }

    public function desabilitar($id, Request $request)
    {
        if($id == auth()->user()->id){
            return redirect()->route('adm.users')->with('erro','Você não pode desabilitar sua propria conta!');
        }else{
            $user = User::findOrFail($id);
            $user->habilitado = 0;
            $user->save();
            Log::notice('Desabilitar Usuario',['Usuario'=>Auth::user()->nome,'ID Usuario Desabilitado'=>$id,'IP'=>$request->ip()]);
            return redirect()->route('adm.users')->with('msg','Desabilitado com sucesso!');
        }
        
    }

    public function habilitar($id, Request $request){
        $user = User::findOrFail($id);
            $user->habilitado = 1;
            $user->save();
            Log::notice('Habilitar Usuario',['Usuario'=>Auth::user()->nome,'ID Usuario Habilitado'=>$id,'IP'=>$request->ip()]);
            return redirect()->route('adm.users')->with('msg','Habilitado com sucesso!');
    }

}
