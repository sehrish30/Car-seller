<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('products')->get();
        return response()->json([
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->order = $request->order;
        $category->save();

        if($request->image){
            // PHP artisan storage:link
            // http://127.0.0.1:8000/images/1627118582aditya-chinchure-H0OSpZ4vJDo-unsplash.jpg
            $image = $request->image;
            $image_new_name = time().$image->getClientOriginalName();
            $image->move(public_path('images'), $image_new_name);
            $category->image = $image_new_name;
            $category->save();
        }
        return response()->json(['status'=> 'success','category' => $category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $category = Category::find($id);
       $category->name = $request->name;
       $category->order = $request->order;
      
       if($request->image && $request->image !== $category->image){
       unlink(public_path('images/' . $request->oldImage));
        $image = $request->image;
        $image_new_name = time().$image->getClientOriginalName();
        $image->move(public_path('images'), $image_new_name);
        $category->image = $image_new_name;
       }
       $category->save();
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $category = Category::find($id);
       $category->delete();

       return response()->json([
           'status' => 'success',
           'message' => 'Category deleted successfully',
       ]);
    }
}
