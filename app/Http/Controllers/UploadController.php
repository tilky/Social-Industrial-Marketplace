<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Input;
use File;
use App\Company;
use App\CompanyGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class UploadController extends Controller
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
    
    /**
     * delete image from gallery
     */
    public function deleteImagesFromGallery($id)
    {
        $resultArray = array();
        $galleryImage = CompanyGallery::find($id);
        $company_id = $galleryImage->company_id;
        $resultArray[] = array($galleryImage->path => true);
        $destinationPath = 'public/uploads/'.$galleryImage->path;
        File::delete($destinationPath);
        $galleryImage->delete();
        return Redirect::to('companies/gallery/'.$company_id)->with('message', 'Selected photo has been deleted.');   
    }
    
    public function removeImagesFromGallery($id){
        $resultArray = array();
        $galleryImage = CompanyGallery::find($id);
        $resultArray[] = array($galleryImage->path => true);
        $destinationPath = 'public/uploads/'.$galleryImage->path;
        File::delete($destinationPath);
        $galleryImage->delete();
        return array("files" => $resultArray);
    }

    public function upload(){
        $destinationPath = 'public/uploads'; // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension

        //check if extension is valid
        if(strtolower($extension) == "png" ||  strtolower($extension) == "jpg" || strtolower($extension) == "jpeg"){
            $fileName = rand(11111,99999).'.'.$extension; // renaming image
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
        $company = Company::find(Input::get("company_id"));
        $allowedImagesInGallery = $company->package->photos_allowed;
        $existingImageCountInGallery = $company->gallery()->count();
        $files = Input::file('files');
        if((count($files) + $existingImageCountInGallery) > $allowedImagesInGallery){
            $resultArray[] = array(
                "name" => $files[0]->getClientOriginalName(),
                "size"=> $files[0]->getSize(),
                "error"=>"Exceeding Limit of gallery",
            );
            return array("files" => $resultArray);
        }

        $destinationPath = 'public/uploads'; // upload path

        $resultArray = array();
        foreach($files as $file){
            $extension = $file->getClientOriginalExtension(); // getting image extension
            if(strtolower($extension) == "png" ||  strtolower($extension) == "jpg" || strtolower($extension) == "jpeg"){
                $size = $file->getSize();
                $fileName = str_replace(' ','_',$company->name).'_'.rand(11111,99999).'.'.$extension; // renaming image
                $file->move($destinationPath, $fileName); // uploading file to given path
                $fullURL = url()."/".$destinationPath."/".$fileName;
                $galleryImage = new CompanyGallery();
                $galleryImage->company_id = $company->id;
                $galleryImage->path = $fileName;
                $galleryImage->save();
                $resultArray[] = array(
                    "name" => $fileName,
                    "size"=> $size,
                    "url"=>$fullURL,
                    "thumbnailUrl"=>$fullURL,
                    "deleteUrl"=>url()."/companies/gallery/remove/".$galleryImage->id,
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
        $destinationPath = 'public/uploads/'.$id;
        File::delete($destinationPath);
    }
}
