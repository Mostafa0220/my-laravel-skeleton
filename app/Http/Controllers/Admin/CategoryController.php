<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Gate;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentCategories = Category::where('parent_id', 0)->orWhereNull('parent_id')->get();
        $allcategories = Category::all()->pluck('name', 'id');

        return view('admin.categories.index', compact('parentCategories', 'allcategories'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4|max:25'
        ]);

        try {


            $category = Category::create($request->all());

            flash('You have successfully added new Category!', 'success');
            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            (config('app.env') == 'local') ? flash('Failed ' . $e->getMessage(), 'danger') : flash('Failed! ', 'danger');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255|string'
        ]);

        $data = $request->except(['_token', '_method']);
        try {
            Category::find($id)->update($data);

            flash('You have successfully updated a Category!', 'success');
            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            (config('app.env') == 'local') ? flash('Failed ' . $e->getMessage(), 'danger') : flash('Failed! ', 'danger');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category->subcategory) {
            foreach ($category->subcategory as $child) {
                if ($child->products) {
                    foreach ($child->products as $product) {
                        $product->category_id = NULL;
                        $product->save();
                    }
                }
            }

            $category->subcategory()->delete();
        }

        if ($category->products) {
            foreach ($category->products as $product) {
                $product->category_id = NULL;
                $product->save();
            }
        }

        $category->delete();
        flash('You have successfully deleted a Category!', 'success');
        return redirect()->route('admin.categories.index');
    }
}
