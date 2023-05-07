<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $primaryKey = 'id_article';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'content',
        'slug',
        'id_user'
    ];
}
