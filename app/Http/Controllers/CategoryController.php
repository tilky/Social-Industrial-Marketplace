<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Input;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Collection;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.Category.index');
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
        //Validations
        $this->validate($request, [
            'name' => 'required'
        ]);

        //Creating category and go back to index.
        $input = $request->all();
        if($input['parent_id'] === ''){
            $input['parent_id'] = null;
        }

        if($input['cat_id'] === ''){
            //create new category
            Category::create($input);
            return Redirect::to('categories')->with('message', 'You have successfully added a new product category.');
        }else{
            //update existing category
            //Updating Industries
            $category = Category::findOrFail($input['cat_id']);

            $input = $request->all();
            if(!isset($input['is_active'])){
                $input['is_active'] = 0;
            }
            $category->fill($input)->save();

            // redirect to index page
            return Redirect::to('categories')->with('message', 'You have successfully updated a product category.');
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Category
        $category = Category::find($id);
        $category->delete();
    }

    /**
     * Get category tree in form of JsTree
     *
     * @param  int  $id
     * @return JSON response
     */
    public function getCategoryTree($id){
        $rootCategories = Category::whereRaw("parent_id IS NULL")->get();
        $resultArray = array();
        foreach($rootCategories as $rootCategory){
            $subCategories = $this->getSubCategories($rootCategory->id,$id);
            $selected = false;
            if($id == $rootCategory->id){
                $selected = true;
            }
            $resultArray[] = array("text"=>$rootCategory->name,"state"=>array("selected"=>$selected),"data"=>$rootCategory->id,"is_active"=>$rootCategory->is_active,"parent_id"=>null,"children"=>$subCategories);
        }
        return $resultArray;
    }

    /**
     * Get sub category of specific category
     *
     * @param  int  $catId
     * @param  int  $currentCategoryId
     * @return JSON response
     */
    public function getSubCategories($catId,$currentCategoryId){
        $categories = Category::where("parent_id","=",$catId)->get();
        if(count($categories) == 0){
            return array();
        }else{
            $resultArray = array();
            foreach($categories as $category){
                $subCategories = $this->getSubCategories($category->id, $currentCategoryId);
                $selected = false;
                if($currentCategoryId == $category->id){
                    $selected = true;
                }
                $resultArray[] = array("text"=>$category->name,"state"=>array("selected"=>$selected),"data"=>$category->id,"is_active"=>$category->is_active,"parent_id"=>$catId,"children"=>$subCategories);
            }
            return $resultArray;
        }
    }
    
    
    public function massImport()
    {
        return view('admin.Category.massImport');
    }
    
    public function saveMassImport(Request $request)
    {

        $this->validate($request, [
            'category_csv' => 'required|mimes:csv,txt'
        ]);
        $categoryArray = array();
        $file = Input::file('category_csv');
        if (!file_exists($file)) die($file. " does not exist!");
        if (file_exists($file)){
        
            $handle = fopen($file, 'r');
        
            $t=0;
        
            while (!feof($handle)) {
                
                $catgory_data = fgetcsv($handle, 1024);
                $t++;
                if($t > 1)
                {
                    if($catgory_data[0] != '')
                    {
                        $categoryArray[$catgory_data[0]]['name'] = $catgory_data[2];
                        $categoryArray[$catgory_data[0]]['parent'] = $catgory_data[3];
                        //echo $catgory_data[0].'=>'.$catgory_data[2].'=>'.$catgory_data[3].'<br/>';   
                    }
                }
            }
        }
        //echo '<pre>';print_r($categoryArray);
        foreach($categoryArray as $key => $value)
        {
            
            if($value['parent'] == 0)
            {
                
                $categoryObj = Category::where('name',$value['name'])->first();
                if(!$categoryObj)
                {
                    $categoryNewObj = new Category();
                    $categoryNewObj->name = $value['name'];
                    $categoryNewObj->parent_id = null;
                    $categoryNewObj->is_active = 1;
                    $categoryNewObj->save();
                }
                //echo $key.'=>'.$value['name'].'=>'.$value['parent'].'<br/>';    
            }
            else
            {
                $categoryObj = Category::where('name',$value['name'])->first();
                if($categoryObj)
                {
                    $paretCategoryObj = Category::where('name',$categoryArray[$value['parent']]['name'])->first();
                    if($paretCategoryObj)
                    {
                        $categoryObj->name = $value['name'];
                        $categoryObj->parent_id = $paretCategoryObj->id;
                        $categoryObj->is_active = 1;
                        $categoryObj->save();
                    }
                    else
                    {
                        $categoryObj->name = $value['name'];
                        $categoryObj->parent_id = null;
                        $categoryObj->is_active = 1;
                        $categoryObj->save();
                    }
                }
                else
                {
                    $categoryNewObj = new Category();
                    $paretCategoryObj = Category::where('name',$categoryArray[$value['parent']]['name'])->first();
                    if($paretCategoryObj)
                    {
                        $categoryNewObj->name = $value['name'];
                        $categoryNewObj->parent_id = $paretCategoryObj->id;
                        $categoryNewObj->is_active = 1;
                        $categoryNewObj->save();
                    }
                    else
                    {
                        $categoryNewObj->name = $value['name'];
                        $categoryNewObj->parent_id = null;
                        $categoryNewObj->is_active = 1;
                        $categoryNewObj->save();
                    }
                }
                //echo $key.'=>'.$value['name'].'=>'.$value['parent'].'=>'.$categoryArray[$value['parent']]['name'].'<br/>';
            }
        }
        return Redirect::to('categories')->with('message', 'You have successfully added a new category.');
    }

    public function viewCategories(){
        $rootCategories = Category::whereRaw("parent_id IS NULL")->paginate(15);

        $previousPageUrl = $rootCategories->previousPageUrl();//previous page url

        $nextPageUrl = $rootCategories->nextPageUrl();//next page url

        $lastPage = $rootCategories->lastPage(); //Gives last page number

        $total = $rootCategories->total();

        return view('admin.Category.viewCategory')->with(['rootCategories'=>$rootCategories,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);

    }
}
