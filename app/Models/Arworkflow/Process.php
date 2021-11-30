<?php

namespace App\Models\Arworkflow;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['created_by', 'bpmn_content', 'bpmn_path', 'svg_content', 'svg_path'];

    public function getBpmnContentAttribute()
    {
        try {
            $path = $this->bpmnPath();
            $content = file_get_contents($path);
            return $content;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getBpmnPathAttribute()
    {
        try {
            return $this->bpmnPath();
        } catch (\Throwable $th) {
            return null;
        }
    }

    private function bpmnPath()
    {
        $processName = $this->slug;
        $bpmnFile = $this->bpmn;
        $path = public_path("storage/workflow/process/{$processName}/{$bpmnFile}");
        return $path;
    }


    public function getSvgContentAttribute()
    {
        try {
            $path = $this->svgPath();
            $content = file_get_contents($path);
            return $content;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getSvgPathAttribute()
    {
        try {
            return $this->svgPath();
        } catch (\Throwable $th) {
            return null;
        }
    }

    private function svgPath()
    {
        $processName = $this->slug;
        $svgFile = $this->svg;
        $path = public_path("storage/workflow/svg/{$processName}/{$svgFile}");
        return $path;
    }

    public function getCreatedByAttribute()
    {
        return User::select('name', 'email')->find($this->user_id);
    }
}
