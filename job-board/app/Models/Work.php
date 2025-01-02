<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Work extends Model
{
    /** @use HasFactory<\Database\Factories\WorkFactory> */
    use HasFactory;
    public static array $category = ["design","finance","hr","it","marketing","sales","management"];
    public static array $experience_levels =  [ 'internship','entry', 'intermediate','junior', 'senior'];

    public function employer() : BelongsTo{
        return $this->belongsTo(Employer::class);
    }


    public function scopeFilter(Builder | QueryBuilder $query, array $filters): Builder | QueryBuilder
    {
        return $query
            ->when($filters['search'] ?? null, fn($query, $search) =>
                $query->where(fn($query) =>
                    $query->where('title', 'like', "%$search%")
                          ->orWhere('description', 'like', "%$search%")
                          ->orWhereHas("employer", fn($query) =>
                            $query->where("company_name", "like", "%$search%")
                          )
                )
            )
            ->when($filters['min_salary'] ?? null, fn($query, $minSalary) =>
                $query->where('salary', '>=', $minSalary)
            )
            ->when($filters['max_salary'] ?? null, fn($query, $maxSalary) =>
                $query->where('salary', '<=', $maxSalary)
            )
            ->when($filters['experience_levels'] ?? null, fn($query, $experienceLevels) =>
                $query->where('experience_levels', '=', $experienceLevels)
            )
            ->when($filters['category'] ?? null, fn($query, $category) =>
                $query->where('category', '=', $category)
            );
    }

}
