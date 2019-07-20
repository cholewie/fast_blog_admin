<?php

namespace App\Http\Controllers\Admin;

use App\Models\CateModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //

    public function cateList()
    {
        //获取分类
        $cates = CateModel::query()->orderByDesc('cate_level')
                                   ->orderByDesc('created_at')
                                   ->paginate(10);
        dd($cates->toArray());
    }
}
