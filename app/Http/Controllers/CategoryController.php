<?php 

namespace App\Http\Controllers; 

use App\Category; 
use Illuminate\Http\Request; 

class CategoryController extends Controller {
    /**
     * @OA\Get(
     *     path="/api/categories/",
     *     summary="Get All Data Categories",
     *     tags={"Categories"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *     )
     * )
     */    
    public function index() {         
        $categories = Category::all();         
        return response()->json($categories);     
    }     
    
    /**
    * @OA\Post(
    *     tags={"Categories"},
    *     path="/api/categories",
    *     summary="Adds a new category",
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="name",
    *                     type="string"
    *                 ),
    *                 example={"name": "Footwear"}
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Success"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Error"
    *     )
    * )
    */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required'   
        ]);  
        Category::create($request->all());         
        return response()->json([            
            'message' => 'Successfull create new category'         
        ]);     
    }     
        
    public function show($id) {         
        $category = Category::find($id);         
        return response()->json($category);     
    }     
    
    public function update(Request $request, $id) {         
        $category = Category::find($id);         
        $category->update($request->all());         
        return response()->json([             
            'message' => 'Successfull update category'         
        ]);     
    }     
    
    /**
     * @OA\Delete(
     *     path="/api/categories/{id}",
     *     summary="Deletes a category",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         description="Category id to delete",
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
     *         description="Category ID is Not Found"
     *     )
     * )
     */
    public function delete($id) {         
        $category = Category::find($id);
        
        if ($category==null) {
            return response('Category not found', 404);
        } 
        else {
            Category::destroy($id);        
            return response()->json([
                'message' => 'Successfull delete category'         
            ]);
        } 
    } 
}