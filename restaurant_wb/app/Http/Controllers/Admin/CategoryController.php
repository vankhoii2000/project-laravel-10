<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $generatedImageName = 'image'.time().'-'
                                    .$request->name.'.'
                                    .$request->image->extension();

        $request->image->move(public_path('images'), $generatedImageName);
                                    
        $category = Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $generatedImageName,
            
        ]);
        
        $category->save();
        
        return redirect('/admin/categories');
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
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
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
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $category = Category::find($id);
        
        $generatedImageName = 'image'.time().'-'
                                    .$request->name.'.'
                                    .$request->image->extension();

        $request->image->move(public_path('images'), $generatedImageName);
        

        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $generatedImageName,
        ]);
        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::find($id);
        $categories -> delete(); 
        return redirect('/admin/categories');
    }
}