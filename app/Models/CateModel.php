<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CateModel extends Model
{

    protected $table = 'categories';

    protected $fillable = [
        'cate_name',
        'cate_p_id',
        'cate_level',
        'cate_status'
    ];

}
