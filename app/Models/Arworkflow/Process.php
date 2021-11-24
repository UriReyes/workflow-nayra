<?php

namespace App\Models\Arworkflow;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['created_by'];

    public function getCreatedByAttribute()
    {
        return User::select('name', 'email')->find($this->user_id);
    }
}
