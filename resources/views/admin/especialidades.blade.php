@extends('layouts.welcome-templateAdmin')
@section('content')
<!-- component -->
<div class="h-screen w-full flex overflow-hidden">
    <main
		class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-700 transition
		duration-500 ease-in-out overflow-y-auto">
		<div class="mx-10 my-2">
			<nav
				class="flex flex-row justify-between border-b
				dark:border-gray-600 dark:text-gray-400 transition duration-500
				ease-in-out">
				<div class="flex items-center select-none">
					<span
						class="hover:text-green-500 dark-hover:text-green-300
						cursor-pointer mr-3 transition duration-500 ease-in-out">

						<svg viewBox="0 0 512 512" class="h-5 w-5 fill-current">
							<path
								d="M505 442.7L405.3
								343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7
								44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1
								208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4
								2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9
								0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7
								0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0
								128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
						</svg>
					</span>

					<input
						class="w-12 bg-transparent focus:outline-none"
						placeholder="Search" />

				</div>

			</nav>
			<h2 class="my-4 text-4xl font-semibold dark:text-gray-400">
				Lista de Especialidades
			</h2>
			<a href="{{route('registrarEspecialidad')}}">
                    <button type="button" class="py-2 px-1 text-white bg-green-500 rounded-lg shadow">
						Añadir Especialidad +
				</button>
           </a>
			<div
				class="mt-6 flex justify-between text-gray-600 dark:text-gray-400">
				<!-- List sorting -->

				<div class="ml-0 pl-1 flex capitalize">
					<!-- Left side -->
					<span class="ml-1 flex items-center">
						Nombre
						<svg
							class="ml-1 h-5 w-5 fill-current text-green-500
							dark:text-green-200"
							viewBox="0 0 24 24">
							<path
								d="M18 21l-4-4h3V7h-3l4-4 4 4h-3v10h3M2
								19v-2h10v2M2 13v-2h7v2M2 7V5h4v2H2z"></path>
						</svg>
					</span>
					<span class="ml-16 pl-1 flex items-center">
						Consultorio
						<svg
							class="ml-1 h-5 w-5 fill-current"
							viewBox="0 0 24 24">
							<path
								d="M18 21l-4-4h3V7h-3l4-4 4 4h-3v10h3M2
								19v-2h10v2M2 13v-2h7v2M2 7V5h4v2H2z"></path>
						</svg>
					</span>
				</div>

				<div class="mr-13 flex capitalize">
					<!-- Right side -->

					<span class="mr-16 pr-5 flex items-center">
						Precio Bs
						<svg
							class="ml-1 h-5 w-5 fill-current"
							viewBox="0 0 24 24">
							<path
								d="M18 21l-4-4h3V7h-3l4-4 4 4h-3v10h3M2
								19v-2h10v2M2 13v-2h7v2M2 7V5h4v2H2z"></path>
						</svg>
					</span>

					<span class="mr-16 pr-2 flex items-center">
						  Editar
						<svg
							class="ml-1 h-5 w-5 fill-current"
							viewBox="0 0 24 24">
							<path
								d="M18 21l-4-4h3V7h-3l4-4 4 4h-3v10h3M2
								19v-2h10v2M2 13v-2h7v2M2 7V5h4v2H2z"></path>
						</svg>
					</span>
				</div>

			</div>
			@foreach($esp as $e)
			<div
				class="mt-2 flex px-4 py-4 justify-between bg-white
				dark:bg-gray-600 shadow-xl rounded-lg">
				<!-- Card -->
				
				<div class="flex justify-between">
					<!-- Left side -->
			
					<div
						class="ml-1 flex flex-col capitalize text-gray-600
						dark:text-gray-400">
						<span class="mt-2 text-black text-center dark:text-gray-200">
                        {{$e->nombreEsp}}
						</span>
					</div>

					<div
						class="ml-20 flex flex-col capitalize text-gray-600
						dark:text-gray-400">
						<span class="mt-2 text-black text-center dark:text-gray-200">
                        {{$e->consultorio}}
						</span>

					</div>

				</div>

				<div class="mr-13 flex capitalize">
					<!-- Rigt side -->

					<div
						class="mr-16 pr-1 flex flex-col capitalize text-gray-600
						dark:text-gray-400">
						<span class="mt-2 items-center text-black dark:text-gray-200">
							{{$e->precio}}
						</span>
					</div>

					<div
						class="mr-16 pr-7 flex flex-col capitalize text-gray-600
						dark:text-gray-400">
						<a class="mt-2 text-blue-400 font-bold dark:text-green-200" href="{{route('editEsp', [$e->id_esp])}}">
							Editar
                        </a>
					</div>
				</div>
              
			</div>
			@endforeach
	</main>
</div>
@endsection