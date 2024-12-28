<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    public static array $category = ["design","finance","hr","it","marketing","sales","management"];
    public static array $experience_lavels =  [ 'internship','entry', 'intermediate','junior', 'senior'];
}
