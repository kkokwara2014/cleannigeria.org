<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name','asc')->get();
        return view('admin.category.index', array('user' => Auth::user()), compact('categories'));
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
        $category=new Category;
        $category->name=$request->name;
        $category->isapproved='1';
        $category->save();

        return redirect()->route('category.index')->with('success','New Item Category added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::where('id', $category->id)->first();
        return view('admin.category.edit', array('user' => Auth::user()), compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category=Category::find($category->id);
        $category->name=$request->name;
        $category->save();

        return redirect()->route('category.index')->with('success','Item Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('deleted','Item Category deleted successfully!');
    }

    public function approve($id){
        $category=Category::find($id);
        $category->isapproved='1';
        $category->save();

        //saving the category approval details
        // $catapproval=new Catapproval;
        // $catapproval->user_id=Auth::user()->id;
        // $catapproval->category_id=$category->id;
        // $catapproval->save();

        //for notification

        return redirect()->back();
    }
}
