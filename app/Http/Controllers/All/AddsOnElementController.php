<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddsOnRequest;
use App\Models\Restaurant;
use App\Models\RestaurantMealAddOnElements;
use App\Models\RestaurantMealAddOnLists;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddsOnElementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function index($id)
    {
        $AddOnList = RestaurantMealAddOnLists::where('id','=',$id)->first();
        $restaurant = Restaurant::select(['name_ar','name_en'])->where('id','=',$AddOnList->resturant_id)->first();
        $AddOnElements = RestaurantMealAddOnElements::where('restaurant_add_on_list_id','=',$id)->get();
        return view('addsOnElement.index')
            ->with('AddOnList',$AddOnList)
            ->with('restaurant',$restaurant)
            ->with('AddOnElements',$AddOnElements);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddsOnRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddsOnRequest $request,$id)
    {
        RestaurantMealAddOnElements::create([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'restaurant_add_on_list_id'=>$id,
        ]);
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'create_msg_Adds_on' => __('main.create_msg_Adds_on_category')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AddsOnRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AddsOnRequest $request, $id)
    {
        $AddOnElement =  RestaurantMealAddOnElements::where('id','=',$id)->first();
        if (!$AddOnElement){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'not_found_msg_Adds_on' => __('main.not_found_msg_Adds_on')]);
        }
        $AddOnElement->update([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
        ]);
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'update_msg_Adds_on' => __('main.update_msg_Adds_on')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $AddOnElement =  RestaurantMealAddOnElements::where('id','=',$id)->first();
        if (!$AddOnElement){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'not_found_msg_Adds_on' => __('main.not_found_msg_Adds_on')]);
        }
        $AddOnElement->delete();
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'delete_msg_Adds_on' => __('main.delete_msg_Adds_on')]);
    }
}
