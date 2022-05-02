<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Consulta;
use App\Models\Bitacora;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
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
        $documento = DB::table('_documentos')->where('id_consulta', '=', $id)->get();
        return view('doctor.documentoconsulta', ['documento' => $documento], ['id'=>$id]);
    }

    public function añadirDoc($id){
        $consulta = Consulta::find($id);

        return view('doctor.formDoc',['consulta'=> $consulta]);
        
    }

    public function uploadDoc(Request $request, $id){
        $file = $request->file('url_doc');
        if(Storage::putFileAs('/public/' . $id . '/', $file, $file->getClientOriginalName())){
          $documento = new Documento();
          $documento->descripcion_doc = $request->input('descripcion');
          $documento->url_diagnostico = $file->getClientOriginalName();
          $documento->id_consulta = $id;
          $documento->save();
          
          $aux = DB::table('consultas')->where('id_con',$id)->value('id_paciente');
          $bitacora = new Bitacora();
          $bitacora->usuario = auth()->user()->name;
          $bitacora->operacion = 'Access & Update';
          $bitacora->hora = date('Y-m-d H:i:s');
          $bitacora->id_paciente = $aux;
          $paciente = DB::table('pacientes')->where('id_pac',$aux)->value('nombrePac');
          $bitacora->nombre_pac = $paciente;
          $bitacora->save();
          
          return redirect()->route('showDocumentos', ['id'=>$id]);
        }
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
    public function update(Request $request, $id)
    {
        //
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
