<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    /** @use HasFactory<\Database\Factories\WorkFactory> */
    use HasFactory;
    public static array $category = ["design","finance","hr","it","marketing","sales","management"];
    public static array $experience_levels =  [ 'internship','entry', 'intermediate','junior', 'senior'];
}
