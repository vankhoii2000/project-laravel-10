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
        // $folder = 'category';
        // $generatedImageName = $folder . time() . '-'
        //     . $request->name . '.'
        //     . $request->image->extension();

        // $request->image->move(public_path('images'), $generatedImageName);

        // $category = Category::create([
        //     'name' => $request->input('name'),
        //     'description' => $request->input('description'),
        //     'image' => $generatedImageName,
        // ]);

        // $category->save();

        // return redirect('/admin/categories')->with('success', 'Category created successfully!');
        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images/categories'), $imageName);

        $menu = Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imageName,
        ]);

        return to_route('admin.categories.index')->with('success', 'Categories created successfully!');
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
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $imageName = $category->image;
        if ($request->hasFile('image')) {

            //Tim ham xoa anh khoi thu muc

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/categories'), $imageName);
        }

        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imageName,
        ]);
        return to_route('admin.catagories.index')->with('success', 'Categories updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->menus()->detach();
        $category->delete();
        return redirect('/admin/categories')->with('success', 'Category deleted successfully!');
    }
}
