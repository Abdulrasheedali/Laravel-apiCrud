<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Optional: You can omit this if your table follows conventions
    protected $table = 'students'; 

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'course',
        'email',
        'phone',
    ];
}
