<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Models\Restaurant;
use App\Models\UserOrder;
use App\Models\UserOrderMeal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RestaurantReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($id)
    {
        $restaurant = Restaurant::select(['id','name_ar','name_en'])->where('id','=',$id)->first();
         $user_orders = UserOrder::where('resturant_id','=',$restaurant->id)
               ->orderBy('created_at')->get();
//         dd($user_orders->toArray());
        $first_order = $user_orders->first();
        $last_order = $user_orders->last();
            if (!$first_order && !$last_order){
                $current_date = Carbon::now()->format('Y-m');
                $next_date = Carbon::now()->addMonth()->format('Y-m');
            }else{
                $first_date = $user_orders->first()->created_at;
                $last_date = $user_orders->last()->created_at;
                $current_date = $first_date->format('Y-m');
                $next_date = $last_date->format('Y-m');
            }
//         if( $user_orders == null){
//             $current_date = Carbon::now()->format('Y-m');
//             $next_date = Carbon::now()->addMonth()->format('Y-m');
//         }else{
//        $first_date = $user_orders->first()->created_at;
//        $last_date = $user_orders->last()->created_at;
//        $current_date = $first_date->format('Y-m');
//        $next_date = $last_date->format('Y-m');
//         }
        return view('report.index')
            ->with('restaurant',$restaurant)
            ->with('next_date',$next_date)
            ->with('current_date',$current_date);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ReportRequest $request,$id)
    {
        $start_date =$request->start_date;
       $end_date = $request->end_date;

       if( $start_date != '' && $end_date != '' ){
           $start_date = Carbon::createFromFormat('Y-m', $request->start_date)->startOfMonth();
            $end_date = Carbon::createFromFormat('Y-m', $request->end_date)->endOfMonth();
            $user_orders = UserOrder::where('resturant_id','=',$id)
                ->where('status','=','4')
                ->whereBetween('created_at', [$start_date.'%',$end_date.'%'])
                ->orderBy('created_at')->get()
                ->groupBy(function($data) {
                    return $data->created_at->format('Y-m');
                });
        }else{
           $html = '
            <tr>
            <td class="text-center" colspan = "6" >'.__('main.no_data').'</td>
            </tr>
            ';
        }
         $orderByDate = [];
        $html = '';
        foreach ($user_orders as $date => $user_orders_list){

            $total_meals_count = 0;
            $total_price = 0.0;
            $total_order_price = 0.0;
            $total_delivery_price = 0.0;
            $total_orders_count = $user_orders_list->count();
            foreach ($user_orders_list as $user_order ){
                $total_price = $total_price + $user_order->total_price;
                $total_order_price = $total_order_price + $user_order->order_price;
                $total_delivery_price = $total_delivery_price + $user_order->delivery_price;
                $total_meals_count = $total_meals_count + UserOrderMeal::where('order_id','=',$user_order->id)->count();
            }
            $html .= '
            <tr>
            <td class="text-center">'.$date.'</td>
            <td class="text-center">'.$total_price.'</td>
            <td class="text-center">'.$total_order_price.'</td>
            <td class="text-center">'.$total_delivery_price.'</td>
            <td class="text-center">'.$total_orders_count.'</td>
            <td class="text-center">'.$total_meals_count.'</td>
            </tr>
            ';
        }

        return response()->json(['html' => $html]);
    }

}
