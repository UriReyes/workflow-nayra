<?php

namespace App\Models\Arworkflow;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['author', 'created_by'];

    public function getCreatedByAttribute()
    {
        return User::select('name', 'email')->find($this->user_id);
    }

    public function getAuthorAttribute()
    {
        $user = User::select('id', 'name')->find($this->user_id);
        return $user->name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
