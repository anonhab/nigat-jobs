<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobBenefit extends Model
{
    use HasFactory;

    protected $table = 'job_benefits';
    protected $fillable = ['job_id', 'benefit'];
    public $timestamps = false;

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
