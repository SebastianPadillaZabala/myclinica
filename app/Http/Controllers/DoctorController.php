<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Especialidad;
use App\Models\Consulta;
use App\Models\EspeDoc;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // get all doctores para consultas - API
    public function index()
    { 
        return response([
            'doctor' => Doctor::orderBy('created_at', 'desc')->with('espe:id_esp,nombreEsp,precio')->get()
        ], 200);
    }

    //crear consulta-api
    public function crearConsulta(Request $request, $id)
     {
        $doctor = Doctor::find($id);
        $attrs = $request->validate([
            'fecha' => 'required|string',
            'hora' => 'required|string',
            'motivo' => 'required|string'
        ]);
        $consulta = Consulta::create([
            'fecha' => $attrs['fecha'],
            'hora' => $attrs['hora'],
            'motivo' => $attrs['motivo'],
            'estado' => 'Pendiente',
            'id_paciente' => auth()->user()->id,
            'id_doctor' => $doctor->id_doc
        ]);

        return response([
            'message' => 'Consulta Creada.',
            'consulta' => $consulta
        ], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function Registrar(){
        $esp = Especialidad::all();
       return view('auth.registrarDoc', ['esp'=>$esp]); 
     }

    public function create(Request $request )
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->tipo = "Doctor";
        $user->password = bcrypt( $request->input('password'));
        $user->save();

        $doctor = new Doctor();
        $doctor->nombreDoc = $request->input('name');
        $doctor->CI = $request->input('CI');
        $doctor->celular = $request->input('celular');
        $doctor->fecha_nac = $request->input('fecha_nac');
        $dato =  $_POST['select'];
        $doctor->id_especialidad = $dato;
        $doctor->id_user = DB::table('users')->max('id');
        $doctor->save();

        $espdoc = new EspeDoc();
        $espdoc->id_especialidad = $dato;
        $espdoc->id_doctor = DB::table('doctores')->max('id_doc');
        $espdoc->save();

        return redirect()->route('showD');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAd()
    {
        $doctores = DB::select('select * from doctores INNER JOIN especialidades 
        on doctores.id_especialidad = especialidades.id_esp');       
            return view('admin.doctores', ['doctores'=>$doctores]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $doctor = Doctor::find($id);
       return view('admin.editDoc', ['doctor'=>$doctor]);
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
        $doctor = Doctor::find($id);

        $doctor->nombreDoc = $request->input('name');
        $doctor->CI = $request->input('CI');
        $doctor->celular = $request->input('celular');
        $doctor->fecha_nac = $request->input('fecha_nac');
        $doctor->save();

        return redirect()->route('showD');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        
        return redirect()->route('');
    }

    public function showAllConsultas()
    {
        $doctor = DB::table('doctores')->where('id_user', auth()->user()->id)->value('id_doc');

        $consultas = DB::table('consultas')
        ->join('doctores', 'consultas.id_doctor', '=', 'doctores.id_doc')
        ->join('pacientes', 'pacientes.id_pac', '=', 'consultas.id_paciente')
        ->select('consultas.*', 'pacientes.nombrePac')
        ->where('consultas.id_doctor', '=', $doctor)->get();
        
        return view('doctor.consultas', ['consultas'=>$consultas]);
     }

     public function showAllConsultasAdmin()
    {
        $consultas = DB::table('consultas')
        ->join('doctores', 'consultas.id_doctor', '=', 'doctores.id_doc')
        ->join('pacientes', 'pacientes.id_pac', '=', 'consultas.id_paciente')
        ->join('especialidades', 'especialidades.id_esp', '=', 'doctores.id_especialidad')
        ->select('doctores.nombreDoc', 'especialidades.nombreEsp','pacientes.nombrePac', 'consultas.*')
        ->get();
        return view('admin.consultas', ['consultas'=>$consultas]);
     }

     public function editConsulta($id){
        $consulta = Consulta::find($id);
        return view('doctor.editConsulta', ['consulta'=>$consulta]);
     }

     public function Econsulta($id){
        $consulta = Consulta::find($id);

        $consulta->estado = $_POST['select'];
        $consulta->save();

        $doctor = DB::table('doctores')->where('id_user', auth()->user()->id)->value('id_doc');    

        $consultas = DB::table('consultas')
        ->join('doctores', 'consultas.id_doctor', '=', 'doctores.id_doc')
        ->join('pacientes', 'pacientes.id_pac', '=', 'consultas.id_paciente')
        ->select('consultas.*', 'pacientes.nombrePac')
        ->where('consultas.id_doctor', '=', $doctor)->get();
        
        return view('doctor.consultas', ['consultas'=>$consultas]);
     }


}
