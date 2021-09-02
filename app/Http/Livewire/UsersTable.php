<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UsersTable extends Component
{
    use WithPagination;

    public $action = 'store';
    public $title = 'Nuevo Usuario';
    public $search = '';
    public $modalToogle = false;
    public $modalToogleRole = false;
    public $name,
        $lastname,
        $username,
        $email,$password,
        $password_confirmation,
        $user_id;

    protected $listeners=['destroy'];

    protected function rules()
    {
        $rules = [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => [
                'required',
                'sometimes',
                'nullable',
                'email',
                Rule::unique('users', 'email')
            ],
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string |min:6|same:password'
        ];

        if($this->action === 'edit')
        {
            $rules['email'] = [
                'required',
                'sometimes',
                'nullable',
                'email',
                Rule::unique('users', 'email')
                   ->ignore($this->user_id)
            ];
            $rules['password'] = 'sometimes|string|nullable|min:6';
            $rules['password_confirmation'] = 'sometimes|string|nullable|min:6|same:password';
        }
        return $rules;
    }

    protected $messages = [
        'name.required' => 'Debe ingresar el nombre del usuario.',
        'name.string' => 'Ingrese un nombre válido',
        'lastname.required' => 'Debe ingresar el apellido del usuario.',
        'lastname.string' => 'Ingrese un apellido válido',
        'email.required' => 'Debe ingresar el correo ',
        'email.unique' => 'El correo ya fue registrado en el sistema',
        'email.email' => 'El correo no es válido',
        'password.required' => 'Debe ingresar su contraseña',
        'password_confirmation.same' => 'Las contraseñas no coinciden',
        'password_confirmation.required' => 'Debe ingresar la confirmacion de contraseña'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view(
            'livewire.users-table',
            [
                'users' => User::where('name','like', "%{$this->search}%")
                    ->where('id','!=',auth()->user()->id)
                    ->orderBy('name')
                    ->paginate(10)
            ]
        );
    }

    public function openModal()
    {
        $this->action = "store";
        $this->modalToogle = true;
        $this->resetForm();
        $this->reset('title');
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->modalToogle = false;
    }

    public function store()
    {
        $data = $this->validate();

        $data['password'] = bcrypt($data['password']);

        try
        {
            DB::beginTransaction();

                User::create($data);
                $this->resetForm();
                $this->closeModal();

            DB::commit();

            return $this-> dispatchBrowserEvent('swalmodal', [
                'type' => 'success',
                'title' => '¡Completado!',
                'text' => 'Registrado con éxito!',
            ]);


        }
        catch (\Exception $e)
        {
            DB::rollback();
            return $this-> dispatchBrowserEvent('swalmodal', [
                'type' => 'warning',
                'title' => '¡Error!',
                'text' => $e->getMessage(),
            ]);
        }
    }

    public function edit(User $user)
    {
        $this->openModal();
        $this->action = "edit";
        $this->title = 'Edición de ' . $user->name;
        $this->name = $user->name;
        $this->lastname = $user->lastname;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->user_id = $user->id;
    }


    public function update(User $user)
    {

        $data = $this->validate();
        $data['password'] = is_null($data['password']) ? $user->password : bcrypt($data['password']);
        $data['email'] = empty($data['email']) ? null : $data['email'];

        try
        {
            DB::beginTransaction();

                $user->update($data);
                $this->resetForm();
                $this->closeModal();

            DB::commit();
            return $this-> dispatchBrowserEvent('swalmodal', [
                'type' => 'success',
                'title' => '¡Completado!',
                'text' => 'Actualizado con éxito',
            ]);

        }
        catch (\Exception $e)
        {
            DB::rollback();
            return $this-> dispatchBrowserEvent('swalmodal', [
                'type' => 'warning',
                'title' => '¡Error!',
                'text' => $e->getMessage(),
            ]);
        }

    }

    public function destroyConfirm($id){
        $this-> dispatchBrowserEvent('swalConfirm', [
            'type' => 'error',
            'title' => '¿Esta seguro de eliminar este usuario?',
            'text' => '¡No podrás revertir tu decisión!',
            'id' => $id,
        ]);
    }

    public function destroy(User $user)
    {
        try
        {
            DB::beginTransaction();

                $user->delete();

            DB::commit();
            return $this-> dispatchBrowserEvent('swalmodal', [
                'type' => 'success',
                'title' => '¡Eliminado!',
                'text' => 'El usuario fue eliminado con éxito',
            ]);

        }
        catch (\Exception $e)
        {
            DB::rollback();
            return $this-> dispatchBrowserEvent('swalmodal', [
                'type' => 'warning',
                'title' => '¡Error!',
                'text' => $e->getMessage(),
            ]);
        }

    }

    public function resetForm()
    {
        $this->reset('name');
        $this->reset('lastname');
        $this->reset('email');
        $this->reset('password');
        $this->reset('password_confirmation');
    }
}
