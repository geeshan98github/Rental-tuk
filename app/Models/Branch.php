<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $table = 'tbl_branches';
    public $timestamps = true;

    protected $fillable = ['name', 'status', 'is_delete', 'postal_id'];

    
    public function cities()
    {
        return $this->hasMany(City::class, 'branch_id');
    }
}