<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantCategoryRequest;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\RestaurantType;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Type::select(['id','name_ar','name_en'])->get();
        return view('restaurantCategory.index')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RestaurantCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
       Type::create([
           'name_ar'=>$request->name_ar,
           'name_en'=>$request->name_en,
       ]);
    return redirect()->back()->with(['success_title' => __('main.success_title'),
        'create_msg_type' => __('main.create_msg_type')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $category = Type::where('id','=',$id)->first();
        if (!$category){
            return redirect()->back()->with(['success_title' => __('main.success_title'),
                'update_msg_type' => __('main.update_msg_type')]);
        }
        $category->update([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            ]);
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'update_msg_type' => __('main.update_msg_type')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $category = Type::where('id','=',$id)->first();
        $restaurants_under_category = RestaurantType::where('type_id','=',$id)->first();
        if (!$category){
            return redirect()->back()->with(['success_title' => __('main.success_title'),
                'update_msg_type' => __('main.update_msg_type')]);
        }
        if ($restaurants_under_category){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'cant_delete_msg_Category_restaurant' => __('main.cant_delete_msg_Category_restaurant')]);
        }else{
            $category->delete();
            return redirect()->back()->with(['success_title' => __('main.success_title'),
                'delete_msg_type' => __('main.delete_msg_type')]);
        }
    }
}
