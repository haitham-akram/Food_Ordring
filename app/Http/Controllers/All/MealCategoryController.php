<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealCategoryRequest;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\RestaurantMeal;
use Illuminate\Http\Request;

class MealCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param $id int
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(int $id)
    {
        $restaurant = Restaurant::select(['name_ar','name_en'])
            ->where('id','=',$id)
            ->first();
        $RestaurantCategories = RestaurantCategory::join('restaurants','restaurantcategories.resturant_id','restaurants.id')
            ->where('resturant_id','=',$id)
        ->get(['restaurantcategories.*','restaurants.name_ar as re_name_ar','restaurants.name_en as re_name_en']);

        return view('mealCategory.index')
            ->with('restaurant_id',$id)
            ->with('restaurant',$restaurant)
            ->with('RestaurantCategories',$RestaurantCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request,$id)
    {
        RestaurantCategory::create([
            'resturant_id'=>$id,
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
        ]);
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'create_msg_Meal_category' => __('main.create_msg_Meal_category')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MealCategoryRequest $request, $id)
    {
        $RestaurantCategory = RestaurantCategory::where('id',$id)->first();
        $RestaurantCategory->update([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
        ]);
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'update_msg_Category_Meal' => __('main.update_msg_Category_Meal')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $RestaurantCategory = RestaurantCategory::where('id',$id)->first();
        $RestaurantMeal = RestaurantMeal::where('resturant_category_id','=',$id)->first();

        if($RestaurantMeal){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'cant_delete_msg_Category_Meal' => __('main.cant_delete_msg_Category_Meal')]);
        }else if(!$RestaurantCategory){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'not_found_msg_Category' => __('main.not_found_msg_Category')]);
        }else{
            $RestaurantCategory->delete();
            return redirect()->back()->with(['success_title' => __('main.success_title'),
                'delete_msg_Category_Meal' => __('main.delete_msg_Category_Meal')]);
        }
    }
}
