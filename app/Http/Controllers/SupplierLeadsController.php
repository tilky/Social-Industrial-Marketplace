<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Industry;

use App\Category;

use App\SupplierLeads;

use App\SupplierLeadCategories;

use App\SupplierLeadIndustries;

use App\UserDetails;

use App\OrderTypes;

use App\SupplierLeadEquipment;

use App\SupplierLeadMaterialsTooling;

use App\SupplierLeadServices;

use App\SupplierLeadConsumableSuppliers;

use App\SupplierLeadSoftware;

use App\UsersActivity;

use App\User;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Route;

use Input;

use Auth;

use Response;

use Session;

use CURLFile;



class SupplierLeadsController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $user_id = Auth::user()->id;

       if($user_id) {
           $user_access_level = Auth::user()->access_level;



           if(Session::get('lead_order_name') != '')

           {

               if(isset($_REQUEST['lead_order_name']))

               {

                   $order_name = $_REQUEST['lead_order_name'];

                   $order_by = $_REQUEST['lead_order_by'];

                   $hidden_val = $order_by;

                   Session::put('lead_order_name', $order_name);

                   Session::put('lead_order_by', $order_by);

                   Session::put('lead_hidden_val', $hidden_val);

                   Session::put('lead_hidden_name', $order_name);

               }

           }

           else

           {

               $order_name = 'created_at';

               $order_by = 'desc';

               $hidden_val = 'desc';

               $hidden_name = 'created_at';

               Session::put('lead_order_name', $order_name);

               Session::put('lead_order_by', $order_by);

               Session::put('lead_hidden_val', $hidden_val);

               Session::put('lead_hidden_name', $hidden_name);

           }



           $order_name = Session::get('lead_order_name');

           $order_by = Session::get('lead_order_by');

           $hidden_val = Session::get('lead_hidden_val');

           $hidden_name = Session::get('lead_hidden_name');


           if($user_access_level == 1)
           {
               $supplierLeads = SupplierLeads::orderBy($order_name, $order_by)->paginate(15);
               foreach($supplierLeads as $supplierLead){
                   $supplierLead->userName = User::find($supplierLead->created_by)->name;
               }
           }
           else
           {
               $supplierLeads = SupplierLeads::where('created_by',$user_id)->orderBy($order_name, $order_by)->paginate(15);
           }

           $previousPageUrl = $supplierLeads->previousPageUrl();//previous page url

           $nextPageUrl = $supplierLeads->nextPageUrl();//next page url

           $lastPage = $supplierLeads->lastPage(); //Gives last page number

           $total = $supplierLeads->total();

           return view('supplierleads.index')->with([

               'supplierLeads'=>$supplierLeads,

               'previousPageUrl'=>$previousPageUrl,

               'nextPageUrl'=>$nextPageUrl,

               'lastPage'=>$lastPage,

               "total"=>$total,

               'user_access_level'=>$user_access_level,

               'lead_hidden_val' => $hidden_val,

               'lead_hidden_name' => $hidden_name

           ]);
       }else{
           return Redirect::to('/');
       }
    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //Output create view.

        $user_id = Auth::user()->id;

        $userData = UserDetails::where('user_id',$user_id)->first();

        

        if($userData == '')

        {

            $userData = new UserDetails();

            $userData->account_type = '';

            $userData->user_id = $user_id;

            $userData->company_id = '';

        }

        // Equipment order types

        $equipmentOrderTypes = OrderTypes::where('order_type','Equipment')->get();

        

        // MaterialsTooling order types

        $materialsToolingOrderTypes = OrderTypes::where('order_type','MaterialsTooling')->get();

        

        // services order types

        $servicesOrderTypes = OrderTypes::where('order_type','Services')->get();

        

        // Software order types

        $softwareOrderTypes = OrderTypes::where('order_type','Software')->get();

        

        // ConsumableSuppliers order types

        $consumableSuppliersOrderTypes = OrderTypes::where('order_type','ConsumableSuppliers')->get();

        

        $industries = Industry::all();

        

        return view('supplierleads.create')->with([

                                        'userData'=>$userData,

                                        'industries' => $industries,

                                        'equipmentOrderTypes'=>$equipmentOrderTypes,

                                        'materialsToolingOrderTypes'=>$materialsToolingOrderTypes,

                                        'servicesOrderTypes'=>$servicesOrderTypes,

                                        'softwareOrderTypes'=>$softwareOrderTypes,

                                        'consumableSuppliersOrderTypes'=>$consumableSuppliersOrderTypes

                                        ]);

    }

    

    /**

     * Catalog upload view

     */

    public function uploadCatalog()

    {

        //Output create view.

        $user_id = Auth::user()->id;

        $userData = UserDetails::where('user_id',$user_id)->first();

        

        if($userData == '')

        {

            $userData = new UserDetails();

            $userData->account_type = '';

            $userData->user_id = $user_id;

            $userData->company_id = '';

        }

        // Equipment order types

        $equipmentOrderTypes = OrderTypes::where('order_type','Equipment')->get();

        

        // MaterialsTooling order types

        $materialsToolingOrderTypes = OrderTypes::where('order_type','MaterialsTooling')->get();

        

        // services order types

        $servicesOrderTypes = OrderTypes::where('order_type','Services')->get();

        

        // Software order types

        $softwareOrderTypes = OrderTypes::where('order_type','Software')->get();

        

        // ConsumableSuppliers order types

        $consumableSuppliersOrderTypes = OrderTypes::where('order_type','ConsumableSuppliers')->get();

        

        $industries = Industry::all();

        

        return view('supplierleads.catalodUpload')->with([

                                        'userData'=>$userData,

                                        'industries' => $industries,

                                        'equipmentOrderTypes'=>$equipmentOrderTypes,

                                        'materialsToolingOrderTypes'=>$materialsToolingOrderTypes,

                                        'servicesOrderTypes'=>$servicesOrderTypes,

                                        'softwareOrderTypes'=>$softwareOrderTypes,

                                        'consumableSuppliersOrderTypes'=>$consumableSuppliersOrderTypes

                                        ]);

    }

    

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function saveCatalog(Request $request)

    {

        $input = $request->all();

        

        

        /// PDF file upload to public folder ///

        $destinationPath = 'public/supplierLead/pdf'; // upload path

        $pdfName = 'catalogfile_'.rand(11111,99999). '.' .$request->file('fileToUpload')->getClientOriginalExtension();

        $request->file('fileToUpload')->move(

            base_path() . '/'.$destinationPath, $pdfName

        );

        

        /**

         * Enable below code after script ready 

        

        $input['file_path'] = 'supplierLead/pdf/'.$pdfName;

        //echo '<pre>';print_r($input);

        

        $target_url = 'https://quotetek.com/cgi-bin/parse';

        //This needs to be the full path to the file you want to send.

    	$file_name_with_full_path = public_path().'/'.$input['file_path'];

        $fileSize = filesize($file_name_with_full_path);

        echo $file_name_with_full_path.'<br/>';

             // curl will accept an array here too.

             // Many examples I found showed a url-encoded string instead.

             // Take note that the 'key' in the array will be the key that shows up in the

             // $_FILES array of the accept script. and the at sign '@' is required before the

             // file name.

             

        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        $finfo = finfo_file($finfo, $file_name_with_full_path);

        

        $cFile = new CURLFile($file_name_with_full_path, $finfo, basename($file_name_with_full_path));

        

        $post = array('userid' => $input['userid'],'fileToUpload'=>$cFile,"filename" => $cFile->postname);

        echo '<pre>';print_r($post);

        $ch = curl_init();

    	curl_setopt($ch, CURLOPT_URL,$target_url);

        curl_setopt($ch, CURLOPT_HTTPHEADER,

            array(

                'Content-Type: multipart/form-data'

            )

        );

    	curl_setopt($ch, CURLOPT_POST,true);

    	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

        curl_setopt($ch, CURLOPT_INFILESIZE, $fileSize);

    	$result=curl_exec ($ch);

    	curl_close ($ch);

    	echo "result: ".$result;

        exit(0);*/

        

        $ajaxDataArray = array();

        $ajaxDataArray['filename'] = $destinationPath.'/'.$pdfName;

        $ajaxDataArray['success'] = true;

        return Response::json($ajaxDataArray);

        

    }

    public function store(Request $request)

    {

        if(Input::has('catalog_upload'))

        {

            $this->validate($request, [

                'industries' => 'required',

                'upload_catalog' => 'required',

            ]);

        }

        else

        {

            if(Input::get('file_path') == '')

            {

                $this->validate($request, [

                    'categories' => 'required',

                ]);    

            }

                

        }                   

        

        

        //Creating accreditations and go back to index.

        $input = $request->all();

        

        $supplierLeads = SupplierLeads::create($input);

        

        $supplier_lead_id = $supplierLeads->id;

        

        /// supplier lead industries value set

        if(Input::has('industries'))

        {

            if($input['industries'][0] == 'all')

            {

                $industries = Industry::all();

                foreach($industries as $industry)

                {

                    $SupplierLeadIndustries = new SupplierLeadIndustries();

                    $SupplierLeadIndustries->supplier_lead_id = $supplier_lead_id;

                    $SupplierLeadIndustries->industry_id = $industry->id;

                    $SupplierLeadIndustries->save();

                }

            }

            else

            {

                foreach(Input::get('industries') as $industry)

                {

                    $SupplierLeadIndustries = new SupplierLeadIndustries();

                    $SupplierLeadIndustries->supplier_lead_id = $supplier_lead_id;

                    $SupplierLeadIndustries->industry_id = $industry;

                    $SupplierLeadIndustries->save();

                }

            }

            

        }

        

        /// supplier lead categories value set

        if(Input::has('categories'))

        {

            $categoryIdsArray = array();

            /// get parents child category

            foreach(Input::get('categories') as $category)

            {

                $childCatObj = Category::whereRaw('parent_id = ? AND is_active = ?',array($category,1))->get()->toArray();

                if(!empty($childCatObj))

                {

                    foreach($childCatObj as $child)

                    {

                        $categoryIdsArray[] = $child['id'];

                    }

                }

                $categoryIdsArray[] = $category;

            }

            

            $leadCatIds = array_unique($categoryIdsArray);

            foreach($leadCatIds as $catId)

            {

                $SupplierLeadCategories = new SupplierLeadCategories();

                $SupplierLeadCategories->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadCategories->category_id = $catId;

                $SupplierLeadCategories->save();

            }   

        }

        

        /// quote equipment order value set

        if(Input::has('equipment'))

        {

            foreach(Input::get('equipment') as $equipment)

            {

                $SupplierLeadEquipment = new SupplierLeadEquipment();

                $SupplierLeadEquipment->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadEquipment->order_type_id = $equipment;

                $SupplierLeadEquipment->save();

            }

        }

        

        /// Supplier Lead Materials Tooling order value set

        if(Input::has('materials_tooling'))

        {

            foreach(Input::get('materials_tooling') as $materials_tooling)

            {

                $SupplierLeadMaterialsTooling = new SupplierLeadMaterialsTooling();

                $SupplierLeadMaterialsTooling->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadMaterialsTooling->order_type_id = $materials_tooling;

                $SupplierLeadMaterialsTooling->save();

            }

        }

        

        /// Supplier Lead services order value set

        if(Input::has('services'))

        {

            foreach(Input::get('services') as $service)

            {

                $SupplierLeadServices = new SupplierLeadServices();

                $SupplierLeadServices->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadServices->order_type_id = $service;

                $SupplierLeadServices->save();

            }

        }

        

        /// Supplier Lead software order value set

        if(Input::has('software'))

        {

            foreach(Input::get('software') as $software)

            {

                $SupplierLeadSoftware = new SupplierLeadSoftware();

                $SupplierLeadSoftware->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadSoftware->order_type_id = $software;

                $SupplierLeadSoftware->save();

            }

        }

        

        /// Supplier Lead comsumable order value set

        if(Input::has('consumable_suppliers'))

        {

            foreach(Input::get('consumable_suppliers') as $consumable_suppliers)

            {

                $SupplierLeadConsumableSuppliers = new SupplierLeadConsumableSuppliers();

                $SupplierLeadConsumableSuppliers->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadConsumableSuppliers->order_type_id = $consumable_suppliers;

                $SupplierLeadConsumableSuppliers->save();

            }

        }

        

        /// User Activity for message

        $usersActivity = new UsersActivity;

        $usersActivity->activity_name = 'You created a new Lead Request.';

        $usersActivity->activity_id = $supplierLeads->id;

        $usersActivity->activity_type = 'lead_status';

        $usersActivity->creater_id = $supplierLeads->created_by;

        $usersActivity->receiver_id = null;

        $usersActivity->save();

        

        return Redirect::to('supplier-leads')->with('message', 'Your Lead Request has been created.');

    }

    

    /**

     * Catalog Upload History

     */

    public function catalogUploadHistory()

    {

        $user_id = Auth::user()->id;

        

        $user_access_level = Auth::user()->access_level;

        

        $supplierLeads = SupplierLeads::whereRaw('created_by = ? AND file_path != ?',array($user_id,''))->orderBy('id','desc')->paginate(15);

        

        $previousPageUrl = $supplierLeads->previousPageUrl();//previous page url

        $nextPageUrl = $supplierLeads->nextPageUrl();//next page url

        $lastPage = $supplierLeads->lastPage(); //Gives last page number

        $total = $supplierLeads->total();

        return view('supplierleads.catalogHistory')->with([

                                                    'supplierLeads'=>$supplierLeads,

                                                    'previousPageUrl'=>$previousPageUrl,

                                                    'nextPageUrl'=>$nextPageUrl,

                                                    'lastPage'=>$lastPage,

                                                    "total"=>$total,

                                                    'user_access_level'=>$user_access_level

                                                    ]);

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

        //Edit Supplier Lead information.

        $SupplierLead = SupplierLeads::find($id);

        $user_id = Auth::user()->id;

        if($SupplierLead->created_by != $user_id)
        {
            return Redirect::to('not-authorized');
        }

        $userData = UserDetails::where('user_id',$user_id)->first();

        $industries = Industry::all();

        $selecteIndustrie = array();

		if(count($SupplierLead->industries)>0){
			foreach($SupplierLead->industries as $industry)
			{

				$selecteIndustrie[] = $industry->industry->id;

			}
		}

        // Equipment order types

        $equipmentOrderTypes = OrderTypes::where('order_type','Equipment')->get();

        $selecteequipments = array();

		if(count($SupplierLead->Equipments)>0){
			foreach($SupplierLead->Equipments as $Equipment)

			{

				$selecteequipments[] = $Equipment->equipment->id;

			}
		}
        

        

        // MaterialsTooling order types

        $materialsToolingOrderTypes = OrderTypes::where('order_type','MaterialsTooling')->get();

        $selecteMaterials = array();

		if(count($SupplierLead->materialsToolings)>0){
			foreach($SupplierLead->materialsToolings as $materialsTooling)

			{

				$selecteMaterials[] = $materialsTooling->materialsTooling->id;

			}
		}
        

        // services order types

        $servicesOrderTypes = OrderTypes::where('order_type','Services')->get();

        $selecteServices = array();

		if(count($SupplierLead->services)>0){
	       foreach($SupplierLead->services as $service)

			{

				$selecteServices[] = $service->service->id;

			}
		}
 

        

        // Software order types

        $softwareOrderTypes = OrderTypes::where('order_type','Software')->get();

        $selecteSoftware = array();

		if(count($SupplierLead->softwares)>0){
			foreach($SupplierLead->softwares as $software)

			{

				$selecteSoftware[] = $software->software->id;

			}
		}
        

        

        // Consubale order types

        $consumableSuppliersOrderTypes = OrderTypes::where('order_type','ConsumableSuppliers')->get();

        $selecteConsumable = array();

		if(count($SupplierLead->consumables)>0){
	        foreach($SupplierLead->consumables as $consumables)

        	{

            	$selecteConsumable[] = $consumables->consumable->id;

        	}

		}



        return view('supplierleads.edit')->with([

                                                'SupplierLead'=>$SupplierLead,

                                                'userData'=>$userData,

                                                'industries'=>$industries,

                                                'selecteIndustrie'=>$selecteIndustrie,

                                                'equipmentOrderTypes'=>$equipmentOrderTypes,

                                                'selecteequipments'=>$selecteequipments,

                                                'materialsToolingOrderTypes'=>$materialsToolingOrderTypes,

                                                'selecteMaterials'=>$selecteMaterials,

                                                'servicesOrderTypes'=>$servicesOrderTypes,

                                                'selecteServices'=>$selecteServices,

                                                'softwareOrderTypes'=>$softwareOrderTypes,

                                                'selecteSoftware'=>$selecteSoftware,

                                                'consumableSuppliersOrderTypes'=>$consumableSuppliersOrderTypes,

                                                'selecteConsumable'=>$selecteConsumable

                                                ]);

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

        // update supplier lead

        $SupplierLead = SupplierLeads::find($id);

        

        //Validations

        $this->validate($request, [

            'industries' => 'required',

            'categories' => 'required',

        ]);

        

        $input = $request->all();

        ///////////////

        $SupplierLead->fill($input)->save();

        

        $supplier_lead_id = $SupplierLead->id;

        

        //first of all delete existing rows of category and create new one.

        SupplierLeadCategories::whereRaw("supplier_lead_id = ? ",array($supplier_lead_id))->delete();

        

        /// supplier lead categories value set

        if(Input::has('categories'))

        {

            $categoryIdsArray = array();

            /// get parents child category

            foreach(Input::get('categories') as $category)

            {

                $childCatObj = Category::whereRaw('parent_id = ? AND is_active = ?',array($category,1))->get()->toArray();

                if(!empty($childCatObj))

                {

                    foreach($childCatObj as $child)

                    {

                        $categoryIdsArray[] = $child['id'];

                    }

                }

                $categoryIdsArray[] = $category;

            }

            

            $leadCatIds = array_unique($categoryIdsArray);

            foreach($leadCatIds as $catId)

            {

                $SupplierLeadCategories = new SupplierLeadCategories();

                $SupplierLeadCategories->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadCategories->category_id = $catId;

                $SupplierLeadCategories->save();

            }   

        }

        

        //first of all delete existing rows of industry and create new one.

        SupplierLeadIndustries::whereRaw("supplier_lead_id = ? ",array($supplier_lead_id))->delete();

        

        /// supplier lead industries value set

        if(Input::has('industries'))

        {

            foreach(Input::get('industries') as $industry)

            {

                $SupplierLeadIndustries = new SupplierLeadIndustries();

                $SupplierLeadIndustries->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadIndustries->industry_id = $industry;

                $SupplierLeadIndustries->save();

            }

        }

        

        /// quote equipment order value set

        if(Input::has('equipment'))

        {

            //first of all delete existing rows and create new one.

            $oldSupplierLeadEquipments = SupplierLeadEquipment::where("supplier_lead_id",$supplier_lead_id)->get();

            foreach($oldSupplierLeadEquipments as $oldSupplierLeadEquipment)

            {

                $oldSupplierLeadEquipment->delete();

            }

            foreach(Input::get('equipment') as $equipment)

            {

                $SupplierLeadEquipment = new SupplierLeadEquipment();

                $SupplierLeadEquipment->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadEquipment->order_type_id = $equipment;

                $SupplierLeadEquipment->save();

            }

        }

        

        /// Supplier Lead Materials Tooling order value set

        if(Input::has('materials_tooling'))

        {

            $oldSupplierLeadMaterialsToolings = SupplierLeadMaterialsTooling::where("supplier_lead_id",$supplier_lead_id)->get();

            foreach($oldSupplierLeadMaterialsToolings as $oldSupplierLeadMaterialsTooling)

            {

                $oldSupplierLeadMaterialsTooling->delete();

            }

            foreach(Input::get('materials_tooling') as $materials_tooling)

            {

                $SupplierLeadMaterialsTooling = new SupplierLeadMaterialsTooling();

                $SupplierLeadMaterialsTooling->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadMaterialsTooling->order_type_id = $materials_tooling;

                $SupplierLeadMaterialsTooling->save();

            }

        }

        

        /// Supplier Lead services order value set

        if(Input::has('services'))

        {

            //first of all delete existing rows and create new one.

            $oldSupplierLeadServices = SupplierLeadServices::where("supplier_lead_id",$supplier_lead_id)->get();

            foreach($oldSupplierLeadServices as $oldSupplierLeadService)

            {

                $oldSupplierLeadService->delete();

            }

            foreach(Input::get('services') as $service)

            {

                $SupplierLeadServices = new SupplierLeadServices();

                $SupplierLeadServices->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadServices->order_type_id = $service;

                $SupplierLeadServices->save();

            }

        }

        

        /// Supplier Lead software order value set

        if(Input::has('software'))

        {

            //first of all delete existing rows and create new one.

            $oldSupplierLeadSoftwares = SupplierLeadSoftware::where("supplier_lead_id",$supplier_lead_id)->get();

            foreach($oldSupplierLeadSoftwares as $oldSupplierLeadSoftware)

            {

                $oldSupplierLeadSoftware->delete();

            }

            foreach(Input::get('software') as $software)

            {

                $SupplierLeadSoftware = new SupplierLeadSoftware();

                $SupplierLeadSoftware->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadSoftware->order_type_id = $software;

                $SupplierLeadSoftware->save();

            }

        }

        

        /// Supplier Lead comsumable order value set

        if(Input::has('consumable_suppliers'))

        {

            //first of all delete existing rows and create new one.

            $oldSupplierLeadConsubles = SupplierLeadConsumableSuppliers::where("supplier_lead_id",$supplier_lead_id)->get();

            foreach($oldSupplierLeadConsubles as $oldSupplierLeadConsuble)

            {

                $oldSupplierLeadConsuble->delete();

            }

            foreach(Input::get('consumable_suppliers') as $consumable_suppliers)

            {

                $SupplierLeadConsumableSuppliers = new SupplierLeadConsumableSuppliers();

                $SupplierLeadConsumableSuppliers->supplier_lead_id = $supplier_lead_id;

                $SupplierLeadConsumableSuppliers->order_type_id = $consumable_suppliers;

                $SupplierLeadConsumableSuppliers->save();

            }

        }

        

        // redirect to index page

        return Redirect::to('supplier-leads')->with('message', 'Your Lead Request has been updated.');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        //Delete Product

        $SupplierLeads = SupplierLeads::find($id);

        $SupplierLeads->delete();

        return Redirect::to('supplier-leads')->with('message', 'Your Lead Request has been deleted.');

    }

    

    /**

     * Lead status update

     */

    public function updateStatus($id,$status)

    {

        $SupplierLead = SupplierLeads::find($id);

        $SupplierLead->status =$status;

        $SupplierLead->save();

        

        /// User Activity for message

        $usersActivity = new UsersActivity;

        $usersActivity->activity_name = 'You Lead Request status has been updated.';

        $usersActivity->activity_id = $SupplierLead->id;

        $usersActivity->activity_type = 'lead_status';

        $usersActivity->creater_id = $SupplierLead->created_by;

        $usersActivity->receiver_id = null;

        $usersActivity->save();

        

        return Redirect::to('supplier-leads')->with('message', 'Your Lead Request has been deleted.');

    }

    public function sellerCategories()
    {
        $supplierLeads = SupplierLeads::paginate(15);
        $supplierLeadsArray = array();
        foreach($supplierLeads as $supplierLead)
        {
            $dataArray = array();
            $dataArray['seller_Name'] = User::find($supplierLead->created_by)->name;
            $categories = SupplierLeadCategories::where('supplier_lead_id',$supplierLead->id)->get()->toArray();
            if(!empty($categories))
            {
                foreach($categories as $category)
                {
                    $categoryArray = array();
                    $categoryArray['category_name'] = Category::find($category['category_id'])->name;
                    $dataArray['supplierCategory'][] = $categoryArray;
                }
            }
            else
            {
                $dataArray['supplierCategory'] = array();
            }
            $supplierLeadsArray[] = $dataArray;
        }
        //echo"<pre>"; print_r($supplierLeadsArray); exit(0);

        $previousPageUrl = $supplierLeads->previousPageUrl();//previous page url

        $nextPageUrl = $supplierLeads->nextPageUrl();//next page url

        $lastPage = $supplierLeads->lastPage(); //Gives last page number

        $total = $supplierLeads->total();

        return view('supplierleads.viewCategories')->with([

            'supplierLeads'=>$supplierLeads,

            'supplierLeadsArray'=>$supplierLeadsArray,

            'previousPageUrl'=>$previousPageUrl,

            'nextPageUrl'=>$nextPageUrl,

            'lastPage'=>$lastPage,

            "total"=>$total

        ]);

    }

    public function categoryPackage()

    {
        $supplierLeads = SupplierLeads::paginate(15);
        foreach($supplierLeads as $supplierLead){

            $userData= User::find($supplierLead->created_by);

            $supplierLead->sellerName = $userData->name;
            $supplierLead->countOfCategory = SupplierLeadCategories::where('supplier_lead_id',$supplierLead->id)->count();
            if($userData->account_member != '' || $userData->account_member != NULL){
                $supplierLead->packageName = $userData->account_member;
            }else{
                $supplierLead->packageName = 'N/A';
            }

        }

        $previousPageUrl = $supplierLeads->previousPageUrl();//previous page url

        $nextPageUrl = $supplierLeads->nextPageUrl();//next page url

        $lastPage = $supplierLeads->lastPage(); //Gives last page number

        $total = $supplierLeads->total();

        return view('supplierleads.categoryPackage')->with([

            'supplierLeads'=>$supplierLeads,

            'previousPageUrl'=>$previousPageUrl,

            'nextPageUrl'=>$nextPageUrl,

            'lastPage'=>$lastPage,

            "total"=>$total

        ]);

    }

}

