<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddsOnCategoryRequest;
use App\Models\Restaurant;
use App\Models\RestaurantMealAddOnElements;
use App\Models\RestaurantMealAddOnLists;
use App\Models\RestaurantMealAddOns;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AddsOnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($id)
    {
        $restaurant = Restaurant::select(['id','name_ar','name_en'])
            ->where('id','=',$id)
            ->first();
        $Adds_on_categories = RestaurantMealAddOnLists::where('resturant_id','=',$id)
            ->get();
        return view('addsOn.index')
            ->with('restaurant',$restaurant)
            ->with('adds_on_categories',$Adds_on_categories);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request,$id)
    {
        RestaurantMealAddOnLists::create([
            'resturant_id'=>$id,
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'type'=>$request->type,
        ]);
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'create_msg_Adds_on_category' => __('main.create_msg_Adds_on_category')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AddsOnCategoryRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(AddsOnCategoryRequest $request, $id)
    {
        $addsOnCategory = RestaurantMealAddOnLists::where('id','=',$id)->first();
        if(!$addsOnCategory){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'not_found_msg_Adds_on_category' => __('main.not_found_msg_Adds_on_category')]);
        }
        $addsOnCategory->update([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'type'=>$request->type,
            ]);
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'update_msg_Adds_on_category' => __('main.update_msg_Adds_on_category')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $addsOnCategory = RestaurantMealAddOnLists::where('id','=',$id)->first();
        $addsOnMeals = RestaurantMealAddOns::where('add_on','=',$id)->get();
        $addsOnElements = RestaurantMealAddOnElements::where('restaurant_add_on_list_id','=',$id)->get();
        if($addsOnElements != []){
            foreach ($addsOnElements as $addsOnElement){
                $addsOnElement->delete();
            }
        }
        if($addsOnMeals != []){
            foreach ($addsOnMeals as $addsOnMeal){
                $addsOnMeal->delete();
            }
        }
        if(!$addsOnCategory){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'not_found_msg_Adds_on_category' => __('main.not_found_msg_Adds_on_category')]);
        }else{
        $addsOnCategory->delete();
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'delete_msg_Adds_on_category' => __('main.delete_msg_Adds_on_category')]);
        }
    }
}
