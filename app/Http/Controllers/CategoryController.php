<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Category::where('type',$request->type)->get();

        return response()->json([
            'data' => $data
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Category();

        $data->name = $request->name;
        $data->image = '/storage/' . $request->file('image')->store('categories','public');
        $data->type = $request->type;

        $data->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Category berhasil ditambahkan',
            'data' => $data
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryController  $categoryController
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryController $categoryController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryController  $categoryController
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryController $categoryController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryController  $categoryController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryController $categoryController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryController  $categoryController
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryController $categoryController)
    {
        //
    }
}
