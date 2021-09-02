<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>


    <x-jet-dialog-modal wire:model="modalToogle">
        <x-slot name="title">
            {{$title}}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2">
                <div class="m-1">
                    <x-jet-label for="name" value="Nombre"/>
                    <x-jet-input wire:model.lazy="name" id="name" type="text" class="mt-1 block w-full" autocomplete="off"/>
                    @error('name')
                        <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                            <span class="block sm:inline text-xs">{{$message}}</span>
                        </div>
                    @enderror
                </div>
                <div class="m-1">
                    <x-jet-label for="lastname" value="Apellido"/>
                    <x-jet-input wire:model.lazy="lastname" id="lastname" type="text" class="mt-1 block w-full" autocomplete="off"/>
                    @error('lastname')
                        <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                            <span class="block sm:inline text-xs">{{$message}}</span>
                        </div>
                    @enderror
                </div>
            </div>
            <br>
            <x-jet-label for="email" value="Correo:"/>
            <x-jet-input
                wire:model.lazy="email"
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                autocomplete="off"
            />
            @error('email')
                <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                    <span class="block sm:inline text-xs">{{$message}}</span>
                </div>
            @enderror
            <br>
            <div class="grid grid-cols-2">
                <div class="m-1">
                    <x-jet-label for="password" value="Contraseña:"/>
                    <x-jet-input
                        wire:model.lazy="password"
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="off"
                    />
                    @error('password')
                        <div class="text-red-700 px-2 py-1 rounded relative" role="alert">
                            <span class="block sm:inline text-xs">{{$message}}</span>
                        </div>
                    @enderror
                </div>
                <div class="m-1">
                    <x-jet-label for="password_confirmation" value="Confirmación de contraseña:"/>
                    <x-jet-input
                        name="password_confirmation"
                        wire:model.lazy="password_confirmation"
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="off"
                    />
                    @error('password_confirmation')
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
                        class="focus:outline-none text-white text-sm py-2.5 px-5 border-b-4 border-gray-700 rounded-md bg-gray-500 hover:bg-gray-800">Crear usuario</button>
                @else
                    <button
                        wire:click="update({{$user_id}})"
                        type="button"
                        class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">Actualizar usuario</button>
                @endif
            </div>
        </x-slot>
    </x-jet-dialog-modal>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                        <a wire:click="openModal()" href="#" class="focus:outline-none text-green-600 text-sm py-2.5 px-5 rounded-md hover:bg-green-100">Nuevo Usuario</a>
                                    </div>
                                </div>
                                @if ($users->count())
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nombre Completo
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Correo Electronico
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($users as $user)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{$user->name.' '.$user->lastname}}
                                                    </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        @if (!empty($user->email))
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{$user->email}}
                                                            </div>
                                                        @else
                                                        <span class="text-red-600">Sin correo electronico</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            @if(auth()->user()->id == 1)
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a
                                                        wire:click="edit({{$user->id}})"
                                                        href="#"
                                                        class="text-indigo-600 hover:text-indigo-900 m-1"
                                                        title="Editar">
                                                        <i class="far fa-edit"></i>
                                                    </a>

                                                    <a
                                                        wire:click="destroyConfirm({{$user->id}})"
                                                        href="#"
                                                        class="text-red-600 hover:text-red-900 m-1"
                                                        title="Eliminar">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                        {{$users->links()}}
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
    @include("scripts.sweetalert")
@endpush
