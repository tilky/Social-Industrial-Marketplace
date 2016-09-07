<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Input;
use File;
use App\MarketplaceProducts;
use App\MarketplaceProductGallery;
use App\Http\Controllers\Controller;

class UploadProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
    }

    public function removeImagesFromGallery($id){
        $resultArray = array();
        $galleryImage = MarketplaceProductGallery::find($id);
        $resultArray[] = array($galleryImage->path => true);
        $destinationPath = 'public/marketplace/product/images/'.$galleryImage->path;
        File::delete($destinationPath);
        $galleryImage->delete();
        return array("files" => $resultArray,'success' => 1);
    }

    public function upload(){
        $marketplaceproduct = MarketplaceProducts::find(Input::get("product_id"));
        $destinationPath = 'public/marketplace/product/images'; // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension

        //check if extension is valid
        if(strtolower($extension) == "png" ||  strtolower($extension) == "jpg" || strtolower($extension) == "jpeg"){
            $fileName = str_replace(' ','_',$marketplaceproduct->name).'_'.rand(11111,99999).'.'.$extension; // renaming image
            Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
            $fullURL = url()."/".$destinationPath."/".$fileName;
            $fileName = $fileName;
            $resultArray = array("fullURL"=>$fullURL,"fileName"=>$fileName);
            return $resultArray;

        }else{
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-type: text/plain');
            exit("Invalid File");
        }
    }
    
    public function uploadMarketplaceDefault(){
        $destinationPath = 'public/marketplace/product/images'; // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension

        //check if extension is valid
        if(strtolower($extension) == "png" ||  strtolower($extension) == "jpg" || strtolower($extension) == "jpeg"){
            $fileName = str_replace(' ','_','marketplace_default').'_'.rand(11111,99999).'.'.$extension; // renaming image
            Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
            $fullURL = url()."/".$destinationPath."/".$fileName;
            $fileName = $fileName;
            $resultArray = array("fullURL"=>$fullURL,"fileName"=>$fileName);
            return $resultArray;

        }else{
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-type: text/plain');
            exit("Invalid File");
        }
    }

    public function uploadGallery(){

        //validations of number of images.
        $marketplaceproduct = MarketplaceProducts::find(Input::get("product_id"));
        $files = Input::file('files');
        
        $destinationPath = 'public/marketplace/product/images'; // upload path

        $resultArray = array();
        foreach($files as $file){
            $extension = $file->getClientOriginalExtension(); // getting image extension
            if(strtolower($extension) == "png" ||  strtolower($extension) == "jpg" || strtolower($extension) == "jpeg"){
                $size = $file->getSize();
                $fileName = str_replace(' ','_',$marketplaceproduct->name).'_'.rand(11111,99999).'.'.$extension; // renaming image
                $file->move($destinationPath, $fileName); // uploading file to given path
                $fullURL = url()."/".$destinationPath."/".$fileName;
                $galleryImage = new MarketplaceProductGallery();
                $galleryImage->product_id = $marketplaceproduct->id;
                $galleryImage->image_type = Input::get('image_type');
                $galleryImage->path = $fileName;
                $galleryImage->save();
                $resultArray[] = array(
                    "name" => $fileName,
                    "size"=> $size,
                    "url"=>$fullURL,
                    "thumbnailUrl"=>$fullURL,
                    "deleteUrl"=>url()."/marketplaceproducts/gallery/remove/".$galleryImage->id,
                    "deleteType"=> "GET"
                );
            }else{
                $size = $file->getSize();
                $resultArray[] = array(
                    "name" => $file->getName(),
                    "size"=> $size,
                    "error"=>"Not supported extension",
                );
            }
        }
        return array("files" => $resultArray);
    }

    public function remove($id){
        // Delete a single file
        $destinationPath = 'public/marketplace/product/images/'.$id;
        File::delete($destinationPath);
    }
}
