<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->tipo = "Paciente";
        $user->password = bcrypt( $request->input('password'));
        $user->save();
    
        $paciente = new Paciente();
        $paciente->nombrePac = $request->input('name');
        $paciente->CI = $request->input('CI');
        $paciente->celular = $request->input('celular');
        $paciente->fecha_nac = $request->input('fecha_nac');
        $paciente->id_user = DB::table('users')->max('id');
        $paciente->save();

        return redirect()->route('dashboardAdmin');
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
    public function showAd()
    {
        $pacientes = DB::select('select * from pacientes INNER JOIN users 
        on pacientes.id_user = users.id');       
            return view('admin.pacientes', ['pacientes'=>$pacientes]);
    }

    public function showForDoctor()
    {   
        $id_doc = DB::table('doctores')->where('id_user', auth()->user()->id)->value('id_doc');
        $pacientes = DB::table('consultas')
        ->join('doctores', 'consultas.id_doctor', '=', 'doctores.id_doc')
        ->join('pacientes', 'pacientes.id_pac', '=', 'consultas.id_paciente')
        ->select('pacientes.*')
        ->where('consultas.id_doctor', '=', $id_doc)
        ->where('consultas.estado', '=', 'Pendiente')
        ->get();
            return view('doctor.pacientes', ['pacientes'=>$pacientes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::find($id);
       return view('admin.editPac', ['paciente'=>$paciente]);
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
        $paciente = Paciente::find($id);

        $paciente->nombrePac = $request->input('name');
        $paciente->CI = $request->input('CI');
        $paciente->celular = $request->input('celular');
        $paciente->fecha_nac = $request->input('fecha_nac');
        $paciente->save();

        return redirect()->route('showP');
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

    public function historial($id){
        $documentos = DB::table('consultas')
        ->join('_documentos', '_documentos.id_consulta', '=', 'consultas.id_con')
        ->select('_documentos.*')
        ->where('consultas.id_paciente', '=', $id)->get();

        $examenes = DB::table('examenes')
        ->join('_documentos', '_documentos.id_docum', '=', 'examenes.id_documento')
        ->select('examenes.*', '_documentos.id_consulta')
        ->where('examenes.id_paciente', '=', $id)->get();

       if(auth()->user()->tipo == "Doctor"){
        return view('doctor.historial',['documentos'=>$documentos],['examenes'=>$examenes]);
       }else{
        return view('admin.historial',['documentos'=>$documentos],['examenes'=>$examenes]);
       }

     }

}
