<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Work as Job;
class JobApplication extends Model
{
    /** @use HasFactory<\Database\Factories\JobApplicationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_id',
        'expected_salary',
        'cv_path',
    ] ;

    public function job():BelongsTo{
        return $this->belongsTo(Job::class,'work_id');
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
