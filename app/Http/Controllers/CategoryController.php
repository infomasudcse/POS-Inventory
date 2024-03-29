<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
   public $title = "Item-Settings";
   public $subtitle = "Category";

    public function index()
    {
        
        $data = ['title'=>$this->title, 'subtitle'=>$this->subtitle];
        return view('admin.category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = Config::where('id',1)->first();
        return view('admin.category.create',['title'=>$this->title, 'subtitle'=>$this->subtitle,'config' => $config]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $config = Config::where('id',1)->first(); 
        $rules = [          
            'name' => 'required|max:30',
        ];
        if(!$config->autobarcode){
            $rules['br_code'] = 'required|max:99|min:10|numeric|unique:categories';
        }        
        $validatedData = $request->validate($rules);
        //validate
        $newCategory = new Category;           
        $newCategory->name = ucfirst($request->name); 
        $newCategory->br_code = ($request->br_code)?:'0';           
        
            if($newCategory->save()){
                return redirect('categories')->with('status', 'Category Just Created!');
            }else{
                return redirect('categories/create')->with('status', 'Something went wrong, Try Again');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {       
        $config = Config::where('id',1)->first();
        return view('admin.category.update',['title'=>$this->title, 'subtitle'=>$this->subtitle,'category'=>$category,'config' => $config]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $config = Config::where('id',1)->first(); 
        $rules = [          
            'name' => 'required|max:30',
        ];
        if(!$config->autobarcode){
            $rules['br_code'] = 'required|max:99|min:10|numeric|unique:categories';
        }
        $validatedData = $request->validate($rules);

        //validate

         $category->name = ucfirst($request->name);
         $category->br_code = ($request->br_code)?:'0';
        if($category->save()){
            return redirect('categories')->with('status', 'Category Updated!');
        }else{
            return redirect('categories/'.$category->$id.'/edit')->with('status', 'Something went wrong, Try Again');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    function getCategory(){

        $categories = Category::all();
         $categoryData =[]; 
         $i=1;       
         foreach($categories as $category){
            $action = "<div class='btn-group'>
                        <a type='button' href='".url('categories/'.$category->id.'/edit')."' class='btn btn-default btn-sx'>Edit</a>
                        </div>";

                $categoryData['data'][] = array($i,$category->br_code,$category->name,$action);
                $i++;
         }
        return json_encode($categoryData);
    }
   

//end     
}

?>