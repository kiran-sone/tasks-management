<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'task_name',
        'project_id',
        'priority',
        'status',
        'due_date',
    ];
}
