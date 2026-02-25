<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model {

    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = ['book_id', 'language', 'title', 'description'];
}
