<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Config;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ConfigTable extends Component
{
    use WithPagination;

    public $action = 'store';
    public $title = 'Nuevo Folio';
    public $search = '';
    public $modalToogle = false;
    public $modalToogleRole = false;
    public $fechaToma, $fechaReporte, $horaToma, $horaReporte, $folio, $nombre, $sexo = "Masculino", $fecha, $pasaporte;

    public $folio_id;

    protected $listeners=['destroy'];

    public function render()
    {
        return view(
            'livewire.config-table',
            [
                'configs' => Config::where('folio','like', "%{$this->search}%")
                    ->orWhere("nombre", 'like', "%{$this->search}%")
                    ->orWhere("pasaporte", 'like', "%{$this->search}%")
                    ->orderBy('folio')
                    ->paginate(10)
            ]
        );
    }

    protected function rules()
    {
        $rules = [
            'fechaToma' => 'required',
            'fechaReporte' => 'required',
            'horaToma' => 'required',
            'horaReporte' => 'required',
            'folio' => 'required|string',
            'nombre' => 'required|string',
            'sexo' => 'required|string',
            'fecha' => 'required',
            'pasaporte' => 'required|string',
        ];

        if($this->action === 'edit')
        {
            $rules['folio'] = [
                'required',
                'string',
                Rule::unique('config', 'folio')
                   ->ignore($this->folio_id)
            ];
        }
        return $rules;
    }

    protected $messages = [
        'folio.required' => 'Ingrese el id del folio',
        'fechaToma.required' => 'Seleccion la fecha',
        'fechaReporte.required' => 'Seleccion la fecha',
        'horaToma.required' => 'Seleccion la hora de la toma',
        'horaReporte.required' => 'Seleccion la hora del reporte',
        'fecha.required' => 'Seleccion la fecha',
        'nombre.required' => 'Debe ingresar el nombre.',
        'nombre.string' => 'Ingrese un nombre v??lido',
        'sexo.required' => 'Seleccione el genero',
        'pasaporte.required' => 'Ingrese el id del pasaporte',
        'pasaporte.string' => 'Ingrese un pasaporte v??lido',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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

        try
        {
            DB::beginTransaction();

                Config::create($data);
                $this->resetForm();
                $this->closeModal();

            DB::commit();

            return $this-> dispatchBrowserEvent('swalmodal', [
                'type' => 'success',
                'title' => '??Completado!',
                'text' => 'Registrado con ??xito!',
            ]);


        }
        catch (\Exception $e)
        {
            DB::rollback();
            return $this-> dispatchBrowserEvent('swalmodal', [
                'type' => 'warning',
                'title' => '??Error!',
                'text' => $e->getMessage(),
            ]);
        }
    }

    public function edit(Config $folio)
    {
        $this->openModal();
        $this->action = "edit";
        $this->title = 'Edici??n de ' . $folio->nombre;
        $this->fechaToma= $folio->fechaToma;
        $this->fechaReporte=  $folio->fechaReporte;
        $this->horaToma= $folio->horaToma;
        $this->horaReporte=  $folio->horaReporte;
        $this->folio= $folio->folio;
        $this->nombre= $folio->nombre;
        $this->sexo= $folio->sexo;
        $this->fecha = $folio->fecha;
        $this->pasaporte = $folio->pasaporte;
        $this->folio_id = $folio->id;
    }


    public function update(Config $folio)
    {

        $data = $this->validate();

        try
        {
            DB::beginTransaction();

                $folio->update($data);
                $this->resetForm();
                $this->closeModal();

            DB::commit();
            return $this->dispatchBrowserEvent('swalmodal', [
                'type' => 'success',
                'title' => '??Completado!',
                'text' => 'Actualizado con ??xito',
            ]);

        }
        catch (\Exception $e)
        {
            DB::rollback();
            return $this-> dispatchBrowserEvent('swalmodal', [
                'type' => 'warning',
                'title' => '??Error!',
                'text' => $e->getMessage(),
            ]);
        }

    }

    public function destroyConfirm($id){
        $this-> dispatchBrowserEvent('swalConfirm', [
            'type' => 'error',
            'title' => '??Esta seguro de eliminar este usuario?',
            'text' => '??No podr??s revertir tu decisi??n!',
            'id' => $id,
        ]);
    }

    public function destroy(Config $folio)
    {
        try
        {
            DB::beginTransaction();

                $folio->delete();

            DB::commit();
            return $this-> dispatchBrowserEvent('swalmodal', [
                'type' => 'success',
                'title' => '??Eliminado!',
                'text' => 'El folio fue eliminado con ??xito',
            ]);

        }
        catch (\Exception $e)
        {
            DB::rollback();
            return $this-> dispatchBrowserEvent('swalmodal', [
                'type' => 'warning',
                'title' => '??Error!',
                'text' => $e->getMessage(),
            ]);
        }

    }

    public function mandarID(Config $folio)
    {
        return $this->dispatchBrowserEvent('trueFolio', ['id' => $folio->folio]);
    }

    public function generatePDF($idFolio)
    {
        $id = substr($idFolio, 0, -4);

        $folio = Config::where('folio', '=' ,$id)->first();
        $codigoQR = QrCode::encoding('UTF-8')->size(130)->generate( route('generate-pdf', $folio->folio));

        $pdf = PDF::loadView(
            'livewire.pdf',
            [
                'folio' => $folio,
                'valor' => $codigoQR
            ]
        )->setPaper("carta", "portrait");

        return $pdf->stream($folio->folio .'.pdf');
    }

    public function resetForm()
    {
        $this->reset('fechaToma');
        $this->reset('fechaReporte');
        $this->reset('horaToma');
        $this->reset('horaReporte');
        $this->reset('folio');
        $this->reset('nombre');
        $this->reset('sexo');
        $this->reset('fecha'); 
        $this->reset('pasaporte');
        $this->reset('folio_id');
    }
}
