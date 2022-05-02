@extends('layouts.template')

@section('content')
<!-- component -->
<div class="h-screen bg-gradient-to-b opacity-85 from-green-500 to-green-400 flex justify-center items-center w-full">
  <form method="POST" action="{{ route('registrar.paciente') }}">
  @csrf
    <div class="bg-white px-10 py-8 rounded-xl w-screen shadow-md max-w-sm">
      <div class="card-body">
        <h1 class="text-center text-2xl font-semibold text-gray-600">Registrar</h1>
        <div>
          <label for="email" class="block mb-1 text-gray-600 font-semibold">Nombre Completo</label>
          <input name="name" type="text" class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"/>
        </div>
        <div>
          <label for="email" class="block mb-1 text-gray-600 font-semibold">Fecha Nacimiento</label>
          <input name="fecha_nac" type="date" class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"/>
        </div>
        <div>
          <label for="email" class="block mb-1 text-gray-600 font-semibold">Celular</label>
          <input name="celular" type="number" class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"/>
        </div>
        <div>
          <label for="email" class="block mb-1 text-gray-600 font-semibold">CI</label>
          <input name="CI" type="number" class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"/>
        </div>
        <div>
          <label for="email" class="block mb-1 text-gray-600 font-semibold">Email</label>
          <input name="email" type="text" class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"/>
        </div>
        <div>
          <label for="email" class="block mb-1 text-gray-600 font-semibold">Password</label>
          <input name="password" type="password" class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"/>
        </div>
        <div>
          <label for="email" class="block mb-1 text-gray-600 font-semibold">Confirmar-Password</label>
          <input name="password_confirmation" type="password" class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"/>
        </div>
      </div>
      <button type="submit" class="mt-4 w-full flex justify-center bg-green-400  hover:bg-green-500 text-gray-100 p-3  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">Registrar</button>
    </div>
  </form>
</div>
@endsection