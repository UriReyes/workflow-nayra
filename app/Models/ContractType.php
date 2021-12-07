<?php

namespace App\Models;

use App\Models\Arworkflow\Process;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'process_id'
    ];

    public function process()
    {
        return $this->belongsTo(Process::class, 'process_id', 'id');
    }
}
