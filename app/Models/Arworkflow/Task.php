<?php

namespace App\Models\Arworkflow;

use App\Traits\InterpreteDeFormulario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    use InterpreteDeFormulario;

    protected $guarded = ['id'];
    // protected $appends = ['formulario_renderizado'];

    public function getFormularioRenderizado($token, $instance)
    {
        $url = route('requests.complete', ['request' => $instance->getId(), 'token' => $token]);
        return $this->interpretar($this->config, $url);
    }
}
