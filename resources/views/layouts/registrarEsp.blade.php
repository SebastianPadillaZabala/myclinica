@extends('layouts.template')

@section('content')
<!-- component -->
<div class="h-screen bg-gradient-to-b opacity-85 from-green-500 to-green-400 flex justify-center items-center w-full">
  <form method="POST" action="{{ route('crearEspecialidad') }}">
  @csrf
    <div class="bg-white px-10 py-8 rounded-xl w-screen shadow-md max-w-sm">
      <div class="card-body">
        <h1 class="text-center text-2xl font-semibold text-gray-600">Registrar Especialidad</h1>
        <div>
          <label for="email" class="block mb-1 text-gray-600 font-semibold">Nombre</label>
          <input name="name" type="text" class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"/>
        </div>
        <div>
          <label for="email" class="block mb-1 text-gray-600 font-semibold">Consultorio</label>
          <input name="consultorio" type="number" class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"/>
        </div>
        <div>
          <label for="email" class="block mb-1 text-gray-600 font-semibold">Precio</label>
          <input name="precio" type="text" class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"/>
        </div>
      </div>
      <button type="submit" class="mt-4 w-full flex justify-center bg-green-400  hover:bg-green-500 text-gray-100 p-3  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">Registrar</button>
    </div>
  </form>
</div>
@endsection