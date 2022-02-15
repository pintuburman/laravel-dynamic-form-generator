<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllForm extends Model
{
    use HasFactory;
    protected $table = 'forms';
    protected $guarded = [];


    public function Schema() {
        return $this->hasMany(FormSchema::class, 'form_id','id');
    }
}
