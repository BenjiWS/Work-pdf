<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Folios') }}
        </h2>
    </x-slot>


    <x-jet-dialog-modal wire:model="modalToogle">
        <x-slot name="title">
            {{$title}}
        </x-slot>
        <x-slot name="content">
            <x-jet-label for="folio" value="Folio ID:"/>
            <x-jet-input
                wire:model.lazy="folio"
                id="folio"
                name="folio"
                type="text"
                class="mt-1 block w-full"
                autocomplete="off"
            />
            @error('folio')
                <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                    <span class="block sm:inline text-xs">{{$message}}</span>
                </div>
            @enderror
            <br>
            <div class="grid grid-cols-2">
                <div class="m-1">
                    <x-jet-label for="fechaToma" value="Fecha Toma"/>
            
                    <input 
                        class="mt-1 block w-full"
                        wire:model.lazy="fechaToma" 
                        type="date" 
                        id="fechaToma"
                        name="fechaToma" >
                    @error('fechaToma')
                        <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                            <span class="block sm:inline text-xs">{{$message}}</span>
                        </div>
                    @enderror
                </div>

                <div class="m-1">
                    <x-jet-label for="horaToma" value="Hora Toma:"/>
                    <input wire:model.lazy="horaToma" name="horaToma" id="horaToma"  class="mt-1 block w-full" type="time" step="1" />
                    @error('horaToma')
                        <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                            <span class="block sm:inline text-xs">{{$message}}</span>
                        </div>
                    @enderror
                </div>
            </div>
            <br>
            <div class="grid grid-cols-2">
                <div class="m-1">
                    <x-jet-label for="fechaReporte" value="Fecha Reporte"/>
                    <input 
                        class="mt-1 block w-full"
                        wire:model.lazy="fechaReporte" 
                        type="date" 
                        id="fechaReporte"
                        name="fechaReporte">

                    @error('fechaReporte')
                        <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                            <span class="block sm:inline text-xs">{{$message}}</span>
                        </div>
                    @enderror
                </div>

                <div class="m-1">
                    <x-jet-label for="horaReporte" value="Hora Reporte:"/>
                    <input wire:model.lazy="horaReporte" class="mt-1 block w-full" name="horaReporte" id="horaReporte" type="time" step="1" />
                    @error('horaReporte')
                        <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                            <span class="block sm:inline text-xs">{{$message}}</span>
                        </div>
                    @enderror
                </div>
            </div>
            <br>
     
            <div class="grid grid-cols-2">
                <div class="m-1">
                    <x-jet-label for="nombre" value="Nombre:"/>
                    <x-jet-input
                        wire:model.lazy="nombre"
                        id="nombre"
                        name="nombre"
                        type="text"
                        class="mt-1 block w-full"
                        autocomplete="off"
                    />
                    @error('nombre')
                        <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                            <span class="block sm:inline text-xs">{{$message}}</span>
                        </div>
                    @enderror
                </div>
                <div class="m-1">
                    <x-jet-label for="pasaporte" value="Pasaporte ID:"/>
                    <x-jet-input
                        name="pasaporte"
                        wire:model.lazy="pasaporte"
                        id="pasaporte"
                        type="text"
                        class="mt-1 block w-full"
                        autocomplete="off"
                    />
                    @error('pasaporte')
                        <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                            <span class="block sm:inline text-xs">{{$message}}</span>
                        </div>
                    @enderror
                </div>
            </div>
            <br>

            <div class="grid grid-cols-2">
                <div class="m-1">
                    <x-jet-label for="fecha" value="Fecha Nac.:"/>
                    <x-jet-input
                        wire:model.lazy="fecha"
                        id="fecha"
                        name="fecha"
                        type="date"
                        class="mt-1 block w-full"
                        autocomplete="off"
                    />
                    @error('fecha')
                        <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                            <span class="block sm:inline text-xs">{{$message}}</span>
                        </div>
                    @enderror
                </div>
                <div class="m-1">
                    <x-jet-label for="sexo" value="Genero:"/>
                    <select
                        wire:model.lazy="sexo"
                        id="sexo"
                        name="sexo"
                        class="mt-1 block w-full"
                        autocomplete="off">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                    </select>
                    @error('sexo')
                        <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                            <span class="block sm:inline text-xs">{{$message}}</span>
                        </div>
                    @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-between">
                <button
                wire:click="$set('modalToogle',false)"
                type="button"
                class="focus:outline-none text-white text-sm py-2.5 px-5 border-b-4 border-red-600 rounded-md bg-red-500 hover:bg-red-400">
                    Cerrar
                </button>
                @if ($action == "store" )
                    <button
                        wire:click="store()"
                        type="button"
                        class="focus:outline-none text-white text-sm py-2.5 px-5 border-b-4 border-gray-700 rounded-md bg-gray-500 hover:bg-gray-800">Crear Folio</button>
                @else
                    <button
                        wire:click="update({{$folio_id}})"
                        type="button"
                        class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">Actualizar Folio</button>
                @endif
            </div>
        </x-slot>
    </x-jet-dialog-modal>


    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                    <input
                                        wire:model="search"
                                        type="text"
                                        name="" id=""
                                        placeholder="Buscar..."
                                        class="form-input rounded-md shadow-sm mt-1 block w-full">

                                    <div class="px-6 py-4 whitespace-nowrap align-text-center text-sm font-medium">
                                        <a wire:click="openModal()" href="#" class="focus:outline-none text-green-600 text-sm py-2.5 px-5 rounded-md hover:bg-green-100">Nuevo Folio</a>
                                    </div>
                                </div>
                                @if ($configs->count())
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Folio ID
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Fecha de Toma
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Fecha de Reporte
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nombre
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Pasaporte
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Genero
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Fecha Nacimiento
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($configs as $folio)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{$folio->folio}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        {{$folio->fechaToma . ' ' . $folio->horaToma}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        {{$folio->fechaReporte . ' ' . $folio->horaReporte}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        {{$folio->nombre}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        {{$folio->pasaporte}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        {{$folio->sexo}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        {{$folio->fecha}}
                                                    </div>
                                                </div>
                                            </td>
                                   
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a
                                                    wire:click="edit({{$folio->id}})"
                                                    href="#"
                                                    class="text-indigo-600 hover:text-indigo-900 m-1"
                                                    title="Editar">
                                                    <i class="far fa-edit"></i>
                                                </a>

                                                <a
                                                    wire:click="destroyConfirm({{$folio->id}})"
                                                    href="#"
                                                    class="text-red-600 hover:text-red-900 m-1"
                                                    title="Eliminar">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                                <a
                                                    wire:click="mandarID({{$folio->id}})"
                                                    class="text-indigo-600 hover:text-indigo-900 m-1" title="Detalle">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </td>
                                       
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                        {{$configs->links()}}
                                    </div>
                                @else
                                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 text-gray-500 text-sm">
                                    No existen resultados para {{$search}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        window.addEventListener('trueFolio', event =>{
            id = event.detail.id;
            var url = `{{ route('generate-pdf', "##") }}`;
            url =  _.replace(url, '##', id + '.pdf');
            window.open(url, '_blank');
        });
    </script>
    @include("scripts.sweetalert")
@endpush
