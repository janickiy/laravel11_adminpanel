<?php

namespace App\Models;

use App\Http\Traits\StaticTableName;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use StaticTableName;

    protected $table = 'category';

    protected $fillable = [
        'name',
    ];
}
