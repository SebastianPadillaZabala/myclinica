<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('auth.log');
//})->middleware('guest');

Route::get('/', [LoginController::class, 'inicio'])
->middleware('guest')
->name('login');

Route::post('/usuario',[PacienteController::class, 'create'])
->middleware('auth')
->name('registrar.paciente');
Route::get('/EditarPaciente/{id}', [PacienteController::class, 'edit'])
->middleware('auth')
->name('editPac');
Route::put('/Epaciente/update/{id}', [PacienteController::class, 'update'])
->name('updatePac');
////verificad quien se logea
Route::post('/loggin',[LoginController::class, 'store'])
->name('loggin');

Route::get('/pAd',[PacienteController::class, 'showAd'])
->middleware('auth')
->name('showP');

//////////Historial
Route::get('/historial/{id}',[PacienteController::class, 'historial'])
->middleware('auth')
->name('showHistorial');
Route::get('/Phistorial',[PDFController::class, 'index'])
->middleware('auth')
->name('PHistorial');
Route::get('/Chistorial/{id}',[PDFController::class, 'show'])
->middleware('auth')
->name('CHistorial');


/////ADMIN Registra Doctor---
//Inserta los datos al nuevo doctor lo crea
Route::post('/cDoctor', [DoctorController::class, 'create'])
->name('creardoctor');
//envia el formulario de registro 
Route::get('/RegistrarDoctor', [DoctorController::class, 'Registrar'])
->middleware('auth')
->name('registrardoctor');
//////mostrar doctores
Route::get('/dAd',[DoctorController::class, 'showAd'])
->middleware('auth')
->name('showD');
//////Editar Doc
Route::get('/EditarDoctor/{id}', [DoctorController::class, 'edit'])
->middleware('auth')
->name('editDoc');
Route::put('/Edoctor/update/{id}', [DoctorController::class, 'update'])
->name('updateDoc');
Route::delete('/delete/{id}', [DoctorController::class, 'destroy'])
->name('deleteDoc');
/////////

//////ADMIN Registra Especialidad
//envia el formulario de registro
Route::get('/RegEsp', [EspecialidadController::class, 'create'])
->middleware('auth')
->name('registrarEspecialidad');
//Inserta la especialidad
Route::post('/cEsp', [EspecialidadController::class, 'store'])
->name('crearEspecialidad');
Route::get('/EditarEspe/{id}', [EspecialidadController::class, 'edit'])
->middleware('auth')
->name('editEsp');
Route::put('/Eespecialidad/update/{id}', [EspecialidadController::class, 'update'])
->name('updateEsp');
Route::get('/eAd',[EspecialidadController::class, 'showEsp'])
->middleware('auth')
->name('showEsp');
/////////

///////Consultas-ADMIN
Route::get('/consultasAd', [DoctorController::class, 'showAllConsultasAdmin'])
->middleware('auth')
->name('showConsultasAdmin');
///////////////////////

///////Consultas-Doctor
Route::get('/consultas', [DoctorController::class, 'showAllConsultas'])
->middleware('auth')
->name('showConsultas');

Route::get('/Econsultas/{id}', [DoctorController::class, 'editConsulta'])
->middleware('auth')
->name('editConsulta');

Route::put('/Econsulta/update/{id}', [DoctorController::class, 'Econsulta'])
->name('consulta.update');

Route::get('/consultadoc/{id}', [DocumentoController::class, 'show'] )
->middleware('auth')
->name('showDocumentos');

Route::get('/formdoc/{id}', [DocumentoController::class, 'añadirDoc'] )
->middleware('auth')
->name('añadirDoc');

Route::post('/uploadDoc/{id}', [DocumentoController::class, 'uploadDoc'] )
->middleware('auth')
->name('uploadDoc');


/////////////////////

///////Laboratorios-ADMIN
Route::get('/laboratorios', [LaboratorioController::class, 'index'] )
->middleware('auth')
->name('showLab');

Route::get('/RegLab', [LaboratorioController::class, 'registro'] )
->middleware('auth')
->name('registroLab');

Route::post('/CreateLab', [LaboratorioController::class, 'create'])
->name('crearLab');

Route::get('/EditarLab/{id}', [LaboratorioController::class, 'edit'] )
->middleware('auth')
->name('editarLab');

Route::put('/EditLab/{id}', [LaboratorioController::class, 'update'])
->name('laboratorio.update');

Route::get('/LabExamen/{id}', [LaboratorioController::class, 'subirExa'] )
->middleware('auth')
->name('subirExa');

Route::post('/UploadEx/{id}', [LaboratorioController::class, 'uploadExa'])
->name('uploadExa');

////////////////////////

///////Pacientes del Doctor
Route::get('/Mypacientes', [PacienteController::class, 'showForDoctor'])
->middleware('auth')
->name('showPacientesDoc');

Route::get('/registrar', function () {
    return view('auth.registrar');
})->name('registrar');

Route::get('/pacientes', function () {
    return view('doctor.dashboard');
})->name('doctor.dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('doctor.dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboardAd', function () {
        return view('admin.dashboard');
    })->name('dashboardAdmin');
});
