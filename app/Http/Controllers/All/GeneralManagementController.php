<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagmentRequest;
use App\Models\Country;
use App\Models\GeneralManagement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GeneralManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        $general_management= GeneralManagement::where('id','=',1)->first();
        return view('general.index')
            ->with('general_management',$general_management)
            ->with('countries',$countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ManagmentRequest $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $show_restaurant_distance = 0;
        $show_closed_restaurants = 0;
        $show_restaurant_working_hours = 0;
//    dd($request->all());
        if ($request->get('show_distance')){
            $show_restaurant_distance = 1;
        }else{
            $show_restaurant_distance = 2;
        }
        if ($request->get('show_closed')){
            $show_closed_restaurants = 1;
        }else{
            $show_closed_restaurants = 2;
        }
        if ($request->get('show_working_hours')){
            $show_restaurant_working_hours = 1;
        }else{
            $show_restaurant_working_hours = 2;
        }

        $general_management= GeneralManagement::where('id','=',1)->first();

       $countries = Country::all();
        $general_management->update([
            'show_resturant_distance'=>$show_restaurant_distance,
            'show_closed_restaurants'=>$show_closed_restaurants
            ,'show_restaurant_working_hours'=>$show_restaurant_working_hours
            ,'maximum_range_users_see'=>$request->maximum_range
            ,'price_per_kilometer'=>$request->price_kilometer
            ,'delivery_price_from'=>$request->start_calculating
            ,'available_payment'=>$request->payment_options
        ]);
        foreach ($countries as $country){
            $country->update(['selected'=>0]);
        }
        $selected_countries = $request->countries;
        foreach ($selected_countries as $selected_country_id){
            Country::where('id','=',$selected_country_id)->update(['selected'=>1]);
            }
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'save_msg_changes' => __('main.save_msg_changes')]);
    }

}
