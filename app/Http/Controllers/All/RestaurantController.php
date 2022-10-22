<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant_Edit_Request;
use App\Http\Requests\RestaurantCategoryRequest;
use App\Http\Requests\RestaurantRequest;
use App\Models\RestaurantCategory;
use App\Models\RestaurantMeal;
use App\Models\RestaurantMealAddOnLists;
use App\Models\RestaurantMealAddOns;
use App\Models\RestaurantType;
use App\Models\Type;
use App\Models\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::get();
        $categories = RestaurantType::join('types','types.id','=','restauranttypes.type_id')
            ->get(['types.*','restauranttypes.resturant_id']);
//        dd($categories->toArray());
        return view('restaurant.index')
            ->with('restaurants',$restaurants)
            ->with('categories',$categories);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Type::select(['id','name_ar','name_en'])->get();

        return view('restaurant.create')->with('categories',$categories);
    }
    //this function for uploading photos in imgur.com
    private function call_uploaded_photo($request,$name)
    {
        $file = $request->file($name);
//        code for uploading photos in imgur
        $file_path = $file->getPathName();
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.imgur.com/3/image', [
            'headers' => [
                'authorization' => 'Client-ID ' . 'd05f17a6dec5c4a',
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'image' => base64_encode(file_get_contents($request->file($name)->path($file_path)))
            ],
        ]);
        return $data[$name] = data_get(response()->json(json_decode(($response->getBody()->getContents())))->getData(), 'data.link');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RestaurantRequest $request)
    {
        $types_id= $request->category_id;
        $logo = $this->call_uploaded_photo($request,'logo');
        $cover_image = $this->call_uploaded_photo($request,'cover_image');
        Restaurant::create([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'logo'=>$logo,
            'cover_image'=>$cover_image,
            'status'=>$request->status,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'monday_open_at'=>$request->monday_open_at,
            'monday_close_at'=>$request->monday_end_at,
            'tuesday_open_at'=>$request->tuesday_open_at,
            'tuesday_close_at'=>$request->tuesday_end_at,
            'wednesday_open_at'=>$request->wednesday_open_at,
            'wednesday_close_at'=>$request->wednesday_end_at,
            'thursday_open_at'=>$request->thursday_open_at,
            'thursday_close_at'=>$request->thursday_end_at,
            'friday_open_at'=>$request->friday_open_at,
            'friday_close_at'=>$request->friday_end_at,
            'saturday_open_at'=>$request->saturday_open_at,
            'saturday_close_at'=>$request->saturday_end_at,
            'sunday_open_at'=>$request->sunday_open_at,
            'sunday_close_at'=>$request->sunday_end_at,
        ]);
        if($logo){
            Session::flash('uploaded', __('main.uploaded'));
        }else{
            Session::flash('not_uploaded',  __('main.not_uploaded'));
        }
        if($cover_image){
            Session::flash('uploaded_2', __('main.uploaded'));
        }else{
            Session::flash('not_uploaded_2',  __('main.not_uploaded'));
        }
//       store restaurant category  'status'=>$request->category_id[], you need to for loop about it and store it
        $restaurant = Restaurant::latest('created_at')->first();
        foreach ($types_id as $type_id){
        RestaurantType::create([
            'resturant_id'=>$restaurant->id,
            'type_id'=>$type_id,
        ]);
        }
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'create_msg_Restaurant' => __('main.create_msg_Restaurant')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurant::where('id','=',$id)->first();
        $types= Type::get();
        $RestaurantTypes = RestaurantType::where('resturant_id',$id)->get();
        $RestaurantType_id = [];
         foreach ($RestaurantTypes as $RestaurantType) array_push($RestaurantType_id,$RestaurantType->type_id);
        return view('restaurant.edit')
            ->with('restaurant',$restaurant)
            ->with('types',$types)
            ->with('RestaurantTypes',$RestaurantType_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Restaurant_Edit_Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Restaurant_Edit_Request $request, $id)
    {
        $restaurant = Restaurant::where('id','=',$id)->first();
//            dd($request->logo,$request->cover_image);
        if ($request->logo != null && $request->cover_image != null){
            $logo = $this->call_uploaded_photo($request,'logo');
            $cover_image = $this->call_uploaded_photo($request,'cover_image');
            $restaurant->update([
                'name_ar'=>$request->name_ar,
                'name_en'=>$request->name_en,
                'description_ar'=>$request->description_ar,
                'description_en'=>$request->description_en,
                'logo'=>$logo,
                'cover_image'=>$cover_image,
                'status'=>$request->status,
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
                'monday_open_at'=>$request->monday_open_at,
                'monday_close_at'=>$request->monday_end_at,
                'tuesday_open_at'=>$request->tuesday_open_at,
                'tuesday_close_at'=>$request->tuesday_end_at,
                'wednesday_open_at'=>$request->wednesday_open_at,
                'wednesday_close_at'=>$request->wednesday_end_at,
                'thursday_open_at'=>$request->thursday_open_at,
                'thursday_close_at'=>$request->thursday_end_at,
                'friday_open_at'=>$request->friday_open_at,
                'friday_close_at'=>$request->friday_end_at,
                'saturday_open_at'=>$request->saturday_open_at,
                'saturday_close_at'=>$request->saturday_end_at,
                'sunday_open_at'=>$request->sunday_open_at,
                'sunday_close_at'=>$request->sunday_end_at,
            ]);
            if($logo){
                Session::flash('uploaded', __('main.uploaded'));
            }else{
                Session::flash('not_uploaded',  __('main.not_uploaded'));
            }
            if($cover_image){
                Session::flash('uploaded_2', __('main.uploaded'));
            }else{
                Session::flash('not_uploaded_2',  __('main.not_uploaded'));
            }
        } elseif ($request->logo != null){
            $logo = $this->call_uploaded_photo($request,'logo');
            $restaurant->update([
                'name_ar'=>$request->name_ar,
                'name_en'=>$request->name_en,
                'description_ar'=>$request->description_ar,
                'description_en'=>$request->description_en,
                'logo'=>$logo,
                'status'=>$request->status,
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
                'monday_open_at'=>$request->monday_open_at,
                'monday_close_at'=>$request->monday_end_at,
                'tuesday_open_at'=>$request->tuesday_open_at,
                'tuesday_close_at'=>$request->tuesday_end_at,
                'wednesday_open_at'=>$request->wednesday_open_at,
                'wednesday_close_at'=>$request->wednesday_end_at,
                'thursday_open_at'=>$request->thursday_open_at,
                'thursday_close_at'=>$request->thursday_end_at,
                'friday_open_at'=>$request->friday_open_at,
                'friday_close_at'=>$request->friday_end_at,
                'saturday_open_at'=>$request->saturday_open_at,
                'saturday_close_at'=>$request->saturday_end_at,
                'sunday_open_at'=>$request->sunday_open_at,
                'sunday_close_at'=>$request->sunday_end_at,
            ]);
            if($logo){
                Session::flash('uploaded', __('main.uploaded'));
            }else{
                Session::flash('not_uploaded',  __('main.not_uploaded'));
            }
        } elseif ($request->cover_image != null){
            $cover_image = $this->call_uploaded_photo($request,'cover_image');
            $restaurant->update([
                'name_ar'=>$request->name_ar,
                'name_en'=>$request->name_en,
                'description_ar'=>$request->description_ar,
                'description_en'=>$request->description_en,
                'cover_image'=>$cover_image,
                'status'=>$request->status,
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
                'monday_open_at'=>$request->monday_open_at,
                'monday_close_at'=>$request->monday_end_at,
                'tuesday_open_at'=>$request->tuesday_open_at,
                'tuesday_close_at'=>$request->tuesday_end_at,
                'wednesday_open_at'=>$request->wednesday_open_at,
                'wednesday_close_at'=>$request->wednesday_end_at,
                'thursday_open_at'=>$request->thursday_open_at,
                'thursday_close_at'=>$request->thursday_end_at,
                'friday_open_at'=>$request->friday_open_at,
                'friday_close_at'=>$request->friday_end_at,
                'saturday_open_at'=>$request->saturday_open_at,
                'saturday_close_at'=>$request->saturday_end_at,
                'sunday_open_at'=>$request->sunday_open_at,
                'sunday_close_at'=>$request->sunday_end_at,
            ]);
            if($cover_image){
                Session::flash('uploaded_2', __('main.uploaded'));
            }else{
                Session::flash('not_uploaded_2',  __('main.not_uploaded'));
            }
        }
        $types_id= $request->category_id;
        $RestaurantTypes = RestaurantType::where('resturant_id',$id)->get();
        Foreach($RestaurantTypes as $restaurantType){
            $restaurantType->delete();
        }

        foreach ($types_id as $type_id) {
            RestaurantType::create([
                'resturant_id' => $restaurant->id,
                'type_id' => $type_id,
            ]);
        }

        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'update_msg_Restaurant' => __('main.update_msg_Restaurant')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::where('id','=',$id)->first();
        if (!$restaurant){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'not_found_msg_restaurant' => __('main.not_found_msg_restaurant')]);
        }
        $meal_categories = RestaurantCategory::where('resturant_id','=',$id)->get();
        //delete all meals categories, addsOns and meals  for that restaurant
        foreach ($meal_categories as $meal_category){
            $meals = RestaurantMeal::where('resturant_category_id','=',$meal_category->id)->get();
            foreach($meals as $meal){
                //get adds on for each meal and delete it.
                $addsOns = RestaurantMealAddOns::where('meal_id','=', $meal->id)->get();
                foreach($addsOns as $addsOn){
                    $addsOn->delete();
                }
                //get meal and delete it.
                $meal->delete();
            }
            //get category meal and delete it.
            $meal_category->delete();
        }
        $AddsOnLists = RestaurantMealAddOnLists::where('resturant_id','=',$id)->get();
        //get adds on list for the restaurant and delete it.
        foreach($AddsOnLists as $AddsOnList){
            $AddsOnList->delete();
        }
        // finally  delete restaurant.
        $restaurant->delete();
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'delete_msg_Restaurant' => __('main.delete_msg_Restaurant')]);
    }
}
