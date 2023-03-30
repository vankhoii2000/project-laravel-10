<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $generatedImageName = 'image' . time() . '-'
        //     . $request->name . '.'
        //     . $request->image->extension();

        // $request->image->move(public_path('images'), $generatedImageName);

        // $menu = Menu::create([
        //     'name' => $request->input('name'),
        //     'price' => $request->input('price'),
        //     'description' => $request->input('description'),
        //     'image' => $generatedImageName,

        // ]);

        // return redirect('/admin/menus')->with('success', 'Menu created successfully!');


        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images/menus'), $imageName);

        $menu = Menu::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $imageName,
        ]);
        if ($request->has('categories')) {
            $menu->categories()->attach($request->categories);
        }

        return to_route('admin.menus.index')->with('success', 'Menu created successfully!');
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
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //     $request->validate([
        //         'name' => 'required',
        //         'description' => 'required',
        //         'price' => 'required',
        //     ]);

        //     $menu = Menu::find($id);
        //     $folder = 'menu';

        //     $generatedImageName = $folder . time() . '-'
        //         . $request->name . '.'
        //         . $request->image->extension();

        //     $request->image->move(public_path('images'), $generatedImageName);

        //     $menu->update([
        //         'name' => $request->input('name'),
        //         'price' => $request->input('price'),
        //         'description' => $request->input('description'),
        //         'image' => $generatedImageName,
        //     ]);

        //     return redirect('/admin/menus')->with('success', 'Menu updated successfully!');
        // 
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
        $imageName = $menu->image;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/menus'), $imageName);
        }

        $menu->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $imageName,
        ]);

        if ($request->has('categories')) {
            $menu->categories()->sync($request->categories);
        }
        return to_route('admin.menus.index')->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->categories()->detach();
        $menu->delete();
        return to_route('admin.menus.index')->with('danger', 'Menu deleted successfully.');
    }
}