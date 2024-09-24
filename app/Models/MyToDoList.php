<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyToDoList extends Model
{
    protected $table = 'my_to_do_lists';
    protected $fillable = [
        'title',
        'completed',
        'due_date'
    ];
    use HasFactory;
}
