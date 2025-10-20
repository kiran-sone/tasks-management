<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'id', 'name',
    ];
    public $timestamps = false;

    public function getProjects() {
        $projects = DB::select('select * from projects');
        return $projects;
    }

    public function getProject($id) {
        $project = Project::where('id', $id)->first();
        return $project;
    }
}
