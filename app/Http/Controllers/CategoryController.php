<?php

namespace App\Http\Controllers;

use App\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index($slug)
    {
        /**where('slug', $slug)->get() */
        $category = $this->category->whereSlug($slug)->first();
// dd($category);
        return view('category', compact('category'));
    }
   
}
