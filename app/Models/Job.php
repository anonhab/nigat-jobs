<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_posts';

    protected $fillable = [
        'title',
        'company',
        'location',
        'salary',
        'type',
        'education',
        'experience',
        'description',
        'posted_at',
        'image',
        'apply_url',
        'apply_email',
        'deadline',
        'source_url',
    ];

    public $timestamps = false;

    /**
     * Default salary behavior
     * If empty → Company Scale
     */
    public function getSalaryAttribute($value): string
    {
        return $value ?: 'Company Scale';
    }

    /* =======================
       Relationships
    ======================== */

    public function benefits()
    {
        return $this->hasMany(JobBenefit::class, 'job_id');
    }

    public function requirements()
    {
        return $this->hasMany(JobRequirement::class, 'job_id');
    }

    public function responsibilities()
    {
        return $this->hasMany(JobResponsibility::class, 'job_id');
    }
}
