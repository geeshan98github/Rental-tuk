<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    use HasFactory;

    protected $table = 'meta_tags';
    public $timestamps = true;

    protected $fillable = [
        'page_name',
        'page_title',
        'description',
        'keywords',
        'og_title',
        'og_type',
        'og_url',
        'og_image',
        'og_sitename',
        'og_description',
        'og_email',
        'status',
        'is_delete'
    ];
}
