<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequirement extends Model
{
    use HasFactory;

    protected $table = 'job_requirements';
    protected $fillable = ['job_id', 'requirement'];
    public $timestamps = false;

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
