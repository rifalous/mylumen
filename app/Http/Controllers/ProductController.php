<?php 

namespace App\Http\Controllers; 

use App\Product; 
use Illuminate\Http\Request; 

class ProductController extends Controller {   
    
    /**
     * @OA\Get(
     *     path="/api/products/",
     *     summary="Get All Data Products",
     *     tags={"Products"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *     )
     * )
     */ 
    public function index() {         
        $products = Product::all();         
        return response()->json($products);     
    }     
    
    /**
    * @OA\Post(
    *     tags={"Products"},
    *     path="/api/products",
    *     summary="Adds a new product",
	*     @OA\Parameter(
	*          in ="header",
	*          name="token",
	*          required=true,
    *          style="form",
	*     ),
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="name",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="category_id",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="slug",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="price",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="weight",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="description",
    *                     type="string"
    *                 ),
    *                 example={
    *                      "name": "Jacket Branded Lossy Wear",
    *                      "category_id": 3,
    *                      "slug": "jacket",
    *                      "price": 300000,
    *                      "weight": 1300,
    *                      "description": "Jacket Branded Lossy Wear"
    *                 }
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Success"
    *     ),
	*     @OA\Response(
	*          response="500",
	*          description="Error"
	*     )
    * )
    */

    public function store(Request $request) {
        $acceptHeader = $request->header('token');

        if ($acceptHeader == 'token') {
            $this->validate($request, [
                'name' => 'required',         
                'category_id' => 'required',         
                'slug' => 'required',         
                'price' => 'required',         
                'weight' => 'required',         
                'description' => 'required',    
            ]);      
            Product::create($request->all()); 
            return response()->json([             
                'message' => 'Successfull create new product'         
            ]);  
        }
        else {
            return response('Not Acceptable', 406);
        }
           
    }     
    
    public function show($id) {         
        $product = Product::find($id);         
        return response()->json($product);     
    }     
    
    public function update(Request $request, $id) {         
        $product = Product::find($id);         
        $product->update($request->all());         
        return response()->json([
            'message' => 'Successfull update product'         
        ]);
    } 
    
    
    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     summary="Deletes a products",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         description="Product id to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product ID is Not Found"
     *     )
     * )
     */
    public function delete($id) {    
        $product = Product::find($id);
        
        if ($product==null) {
            return response('Product not found', 404);
        } 
        else {
            Product::destroy($id);        
            return response()->json([
                'message' => 'Successfull delete product'         
            ]);
        }
         
    }
} 