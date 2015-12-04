<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $category->name = trans("app.business.category.$category->slug");
        }
        $selectedCategory = $categories->first();
        return compact('categories', 'selectedCategory');
    }
}
