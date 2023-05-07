<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $table = 'articles_categories';
    protected $primaryKey = ['id_article', 'id_category'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_article',
        'id_category'
    ];
}
