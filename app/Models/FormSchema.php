<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSchema extends Model
{
    use HasFactory;
    protected $table = 'form_schema';
    protected $guarded = [];

    public function SchemaMeta() {
        return $this->hasMany(FormSchemaMeta::class, 'form_schema_id','id');
    }
}
