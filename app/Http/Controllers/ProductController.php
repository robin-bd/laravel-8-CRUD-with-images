<?php 
namespace App\Http\Controllers;  

use App\Models\Product;
use Illuminate\Http\Request;
    

class ProductController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // set permission
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        return view('products.create');
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price'=>'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
        ]); 

        $input = $request->all();  

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $input['image'] = "$productImage";
        } 

        Product::create($input);        

        return redirect()->route('products.index')->with('success','Product created successfully.');
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price'=>'required',
        ]);

        $input = $request->all();  

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $input['image'] = "$productImage";
        }else{
            unset($input['image']);
        }          

        $product->update($input);
   

        return redirect()->route('products.index')->with('success','Product updated successfully');
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $ImagePath = 'image/'.$product->image;
        unset($ImagePath);
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

  
}