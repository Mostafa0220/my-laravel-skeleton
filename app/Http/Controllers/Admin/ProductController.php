<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if (request()->ajax()) {
            return $this->datatables();
        }

        return view('admin.products.index');
    }
    protected function datatables()
    {
        $product = Product::all();
        return DataTables::of($product)
            ->addColumn('action', function ($product) {
                return view('admin.components.action-buttons', [
                    'edit_url' => route('admin.products.edit', $product->id),
                    'delete_url' => route('admin.products.destroy', $product->id),
                    'show_url' => route('admin.products.show', $product->id)
                ]);
            })
            ->addColumn('created_at', function ($product) {
                return $product->created_at->format('d F Y \a\t h:i A');
            })
            ->escapeColumns([])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::Pluck('name', 'id');

        return view('admin.products.create', compact('categories'));
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
            'name' => 'required|min:4|max:25',
            'category_id' => 'required|integer'
        ]);
        //Populate model
        $product = new Product($request->except(['image']));

        $product->save();

        //Store Image
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $product->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect("/administrator/products/{$product->id}")->with('success', 'New Gift Added !');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        //dd($product);
        $categories = Category::Pluck('name', 'id');

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'required|min:4|max:25',
            'category_id' => 'required|integer'
        ]);
        try {

            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->description = $request->description;

            $user->save();

            flash('Product ' . $product->name . ' successfully updated', 'success');

            return redirect()->back();
        } catch (\Exception $e) {
            (config('app.env') == 'local') ? flash('Failed ' . $e->getMessage(), 'danger') : flash('Failed! ', 'danger');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        $product = Product::findOrFail($id);


        try {
            $product->delete();

            flash('Product ' . $product->name . ' successfully deleted', 'success');

            return redirect()->back();
        } catch (\Exception $e) {
            (config('app.env') == 'local') ? flash('Failed ' . $e->getMessage(), 'danger') : flash('Failed! ', 'danger');
            return redirect()->back();
        }
    }
}
