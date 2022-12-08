<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meal_Edit_Request;
use App\Http\Requests\MealRequest;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\RestaurantMeal;
use App\Models\RestaurantMealAddOnLists;
use App\Models\RestaurantMealAddOns;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $id int
     * @return Application|Factory|View|Response
     */
    public function index(int $id)
    {
        $restaurant = Restaurant::select(['id','name_ar','name_en'])
            ->where('id','=',$id)
            ->first();
        $meals = RestaurantMeal::join('restaurantcategories','restaurantmeals.resturant_category_id','=','restaurantcategories.id')
            ->where('restaurantcategories.resturant_id','=',$id)
            ->get(['restaurantmeals.*','restaurantcategories.name_ar as rc_name_ar','restaurantcategories.name_en as rc_name_en']);
        return view('meal.index')
            ->with('meals',$meals)
            ->with('restaurant',$restaurant);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function create($id)
    {
        $restaurant = Restaurant::select(['id','name_ar','name_en'])
            ->where('id','=',$id)
            ->first();
        $meal_categories = RestaurantCategory::where('resturant_id','=',$id)->get();
        $addsOnCategories = RestaurantMealAddOnLists::select(['id','name_ar','name_en'])->where('resturant_id','=',$id)->get();
        return view('meal.create')
            ->with('restaurant',$restaurant)
            ->with('addsOnCategories',$addsOnCategories)
            ->with('meal_categories',$meal_categories);

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
     * @param MealRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $image = $this->call_uploaded_photo($request,'image');
      $meal= RestaurantMeal::create([
           'name_ar'=>$request->name_ar,
           'name_en'=>$request->name_en,
           'description_ar'=>$request->description_ar,
           'description_en'=>$request->description_en,
           'price'=>floatval($request->price),
           'resturant_category_id'=>$request->meal_category,
           'image'=>$image,
       ]);
       if($image){
           Session::flash('uploaded', __('main.uploaded'));
       }else{
           Session::flash('not_uploaded',  __('main.not_uploaded'));
       }

        if ($request->Adds_on_category_id != null){
        foreach ($request->Adds_on_category_id as $category_id){
            RestaurantMealAddOns::create([
                'meal_id'=>$meal->id,
                'add_on'=>$category_id,
            ]);
        }
        }

       return redirect()->back()->with(['success_title' => __('main.success_title'),
           'create_msg_Meal' => __('main.create_msg_Meal')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {

        $meal = RestaurantMeal::where('id','=',$id)->first();
        $restaurant = RestaurantCategory::join('restaurants','restaurants.id','=','restaurantcategories.resturant_id')
            ->where('restaurantcategories.id','=',$meal->resturant_category_id)
            ->first(['restaurants.id as resturant_id','restaurants.name_ar as re_name_ar','restaurants.name_en as re_name_en']);
        $meal_categories = RestaurantCategory::where('resturant_id','=',$restaurant->resturant_id)->get();
        $addsOnCategory = RestaurantMealAddOnLists::select(['id','name_ar','name_en'])
            ->where('resturant_id','=',$restaurant->resturant_id)
            ->get();
        $selected_adds_ons=RestaurantMealAddOns::where('meal_id','=',$id)->get();
        $selected_adds_on_id = [];
        if ($selected_adds_ons) {
            foreach ($selected_adds_ons as $selected_adds_on) $selected_adds_on_id[] = $selected_adds_on->add_on;
        }
        return view('meal.edit')
            ->with('meal',$meal)
            ->with('restaurant',$restaurant)
            ->with('addsOnCategories',$addsOnCategory)
            ->with('selected_adds_on_id',$selected_adds_on_id)
            ->with('meal_categories',$meal_categories);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param Meal_Edit_Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $meal = RestaurantMeal::where('id','=',$id)->first();
        if (!$meal){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'not_found_msg_meal' => __('main.not_found_msg_meal')]);
        }
        if ($request->image_edit !=null ){
            $image = $this->call_uploaded_photo($request,'image_edit');
            $meal->update([
                'name_ar'=>$request->name_ar,
                'name_en'=>$request->name_en,
                'description_ar'=>$request->description_ar,
                'description_en'=>$request->description_en,
                'price'=>floatval($request->price),
                'resturant_category_id'=>$request->meal_category,
                'image'=>$image,
            ]);
            if($image){
                Session::flash('uploaded', __('main.uploaded'));
            }else{
                Session::flash('not_uploaded',  __('main.not_uploaded'));
            }
        }else{
                $meal->update([
                    'name_ar'=>$request->name_ar,
                    'name_en'=>$request->name_en,
                    'description_ar'=>$request->description_ar,
                    'description_en'=>$request->description_en,
                    'price'=>floatval($request->price),
                    'resturant_category_id'=>$request->meal_category,
                ]);
        }

            $selected_adds_ons=RestaurantMealAddOns::where('meal_id','=',$id)->get();
            foreach ($selected_adds_ons as $selected_adds_on){
                $selected_adds_on->forceDelete();
//                $selected_adds_on->delete();
            }
            if($request->Adds_on_category_id != null){
            foreach ($request->Adds_on_category_id as $category_id){
                RestaurantMealAddOns::create([
                    'meal_id'=>$meal->id,
                    'add_on'=>$category_id,
                ]);
            }
            }
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'update_msg_Meal' => __('main.update_msg_Meal')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
       $meal = RestaurantMeal::where('id','=',$id)->first();
        if (!$meal){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'not_found_msg_meal' => __('main.not_found_msg_meal')]);
        }
        $AddsOns= RestaurantMealAddOns::where('meal_id','=',$id)->get();
        if($AddsOns){
            foreach ($AddsOns as $addsOn){
                $addsOn->delete();
            }
        }
        $meal->delete();
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'delete_msg_Meal' => __('main.delete_msg_Meal')]);
    }

}
