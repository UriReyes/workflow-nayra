<?php

namespace App\Models\Arworkflow;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ProcessMaker\Laravel\Facades\Nayra;
use ProcessMaker\Laravel\Models\Request as NayraRequest;

class Request extends Model
{
    use HasFactory;

    protected $appends = ['instance', 'request'];

    protected $casts = [
        'data' => 'array',
        'tokens' => 'array',
    ];
    // public function getNameAttribute()
    // {
    //     $tokens = collect(json_decode($this->tokens, true));
    //     $tokens = collect($tokens)->mapWithKeys(function ($a) {
    //         return $a;
    //     });
    //     if (count($tokens)) {
    //         return $tokens['name'];
    //     }
    //     return 'Sin nombre';
    // }
    public function getInstanceAttribute()
    {
        $instance = Nayra::getInstanceById($this->id);
        return $instance;
    }

    public function getRequestAttribute()
    {
        $request = NayraRequest::find($this->id);
        return $request;
    }
}
