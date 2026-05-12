<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'designation',
        'company_name',
        'heading_tag',
        'comment',
        'profile_image',
        'status',
        'is_delete',
        'order',
    ];
}
