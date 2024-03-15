<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Product\ProductResource;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $products =  Product::query()
            ->with('category')
            ->latest()
            ->get();

            return DataTables::of($products)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $route_edit = route('admin.products.edit', $row->id);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_edit'>Edit</a>";

                                if ($row->is_available == true) {
                                    $btn .= "
                                    <a class='dropdown-item' href='javascript:void(0)' onclick='crud_activate_deactivate($row->id, `admin.products.update` , `deactivate`, `.product_dt`, `Deactivate Product`)'> Deactivate </a>";
                                } else {
                                    $btn .= "
                                    <a class='dropdown-item' href='javascript:void(0)' onclick='crud_activate_deactivate($row->id, `admin.products.update` , `activate`, `.product_dt`, `Activate Product`)'> Activate </a>";
                                }
                
                               $btn .="<a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`admin.products.destroy`,`.product_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.product.index');
    }

    public function create()
    {
        return view('admin.product.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(ProductRequest $request)
    {
         Product::create($request->validated() + [
            'slug' => Str::slug($request->name),
        ]);
        
        return to_route('admin.products.index')->with(['success' => "Product Added Successfully"]);
    }

    public function show(Product $product)
    {
        return view('admin.product.show', [
            'product' => $product->load('media', 'category', 'varieties', 'supplier'),
        ]);
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        if ($request->option) {
            return match($request->option) {
                'activate' => $product->update(['is_available' => true]),
                'deactivate' => $product->update(['is_available' => false]),
            };
        }

        $product->update($request->validated() + [
            'slug' => Str::slug($request->name),
        ]); // update product
        
        return to_route('admin.products.index')->with(['success' => 'Product Updated Successfully']);
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return $this->res(['success' => 'Product Deleted Successfully']);
    }
}