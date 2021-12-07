<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    const STATUSES = [
        'APROVED',
        'CLOSED',
        'DRAFT',
        'WAITING_FOR_APPROVAL',
        'REVISED'
    ];

    protected $fillable = [
        'name',
        'description',
        'slug',
        'file',
        'status',
        'contract_type_id',
        'user_id',
    ];

    protected $appends = ['path_contract', 'svg_process'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(ContractType::class, 'contract_type_id', 'id');
    }

    public function getPathContractAttribute()
    {
        $path = '/storage/contratos/' . $this->file;
        return $path;
    }

    public function getSVGProcessAttribute()
    {
        $path = asset('storage/workflow/svg/' . $this->type->process->slug . '/' . $this->type->process->svg);
        return $path;
    }
}
