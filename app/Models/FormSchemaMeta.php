<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSchemaMeta extends Model
{
    use HasFactory;
    protected $table = 'form_type_schema_meta';
    protected $guarded = [];
}
