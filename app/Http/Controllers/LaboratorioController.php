<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorio;
use App\Models\User;
use App\Models\Examen;
use App\Models\Bitacora;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lab = Laboratorio::all();
        return view('admin.lab', ['lab'=>$lab]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function registro()
     {
        return view('auth.registrarLab'); 
    }

    public function create(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->tipo = "Laboratorio";
        $user->password = bcrypt( $request->input('password'));
        $user->save();

        $laboratorio = new Laboratorio();
        $laboratorio->nombrelab = $request->input('name');
        $laboratorio->id_user = DB::table('users')->max('id');
        $laboratorio->save();

        return redirect()->route('showLab');
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
        $laboratorio = Laboratorio::findOrFail($id);
        return view('admin.editarLab', ['lab'=>$laboratorio]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $laboratorio = Laboratorio::find($id);
        $laboratorio->nombrelab = $request->input('name');
        $laboratorio->save();
        return redirect()->route('showLab');
    }

    public function subirExa($id)
    {   
        $laboratorio = Laboratorio::find($id);
        return view('laboratorio.subirDoc',['laboratorio'=>$laboratorio]);
    }

    public function uploadExa(Request $request, $id)
    {    
        $file = $request->file('exa');
        if(Storage::putFileAs('/public/' . $request->input('id_documento') . '/', $file, $file->getClientOriginalName())){
          $examen = new Examen();
          $examen->nombre_examen = $request->input('name');
          $examen->url_examen = $file->getClientOriginalName();
          $examen->id_documento = $request->input('id_documento');
          $examen->id_paciente = $request->input('id_paciente');
          $examen->id_laboratorio = $id;
          $examen->save();

          $bitacora = new Bitacora();
          $bitacora->usuario = auth()->user()->name;
          $bitacora->operacion = 'Access & Update';
          $bitacora->hora = date('Y-m-d H:i:s');
          $bitacora->id_paciente = $request->input('id_paciente');
          $paciente = DB::table('pacientes')->where('id_pac',$request->input('id_paciente'))->value('nombrePac');
          $bitacora->nombre_pac = $paciente;
          $bitacora->save();
            return redirect()->route('subirExa',['id'=>$id]);
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
