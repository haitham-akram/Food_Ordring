<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\UserOrderMeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{


    /**
     * Show the tables of orders.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $status = UserOrder::selectRaw("count(case when userorders.status = 1 then 1 end) as count")
            ->selectRaw("count(case when userorders.status = 2 then 1 end) as count_preparing")
            ->selectRaw("count(case when userorders.status = 3 then 1 end) as count_on_way")
            ->selectRaw("count(case when userorders.status = 4 then 1 end) as count_delivered")
            ->first();
        $user_orders = UserOrder::join('users','userorders.user_id','users.id')
            ->where('userorders.status','!=',4)
            ->orderBy('userorders.created_at')
            ->get(['userorders.*',
                'users.name as username', 'users.email','users.phone_number','users.country_code'
            ]);
        $old_orders = UserOrder::join('users','userorders.user_id','users.id')
            ->where('userorders.status','=',4)
            ->orderBy('userorders.updated_at','desc')
            ->get(['userorders.*',
                'users.name as username', 'users.email','users.phone_number','users.country_code'
            ]);
        return view('order.current')
            ->with('status',$status)
            ->with('old_orders',$old_orders)
            ->with('orders',$user_orders);
    }
    //To show order details
    public function show (Request $request){
        $id = $request->id;
        $order_details = UserOrder::join('restaurants','restaurants.id','=','userorders.resturant_id')
            ->join('userordermeals','userordermeals.order_id','userorders.id')
            ->join('restaurantmeals','userordermeals.meal_id','restaurantmeals.id')//meals are found here
            ->where('userorders.id','=',$id)
            ->get([
                'userorders.id as order_id', 'userorders.total_price','userordermeals.meal_price','userordermeals.quantity'
                ,'restaurantmeals.name_ar as meal_name_ar','restaurantmeals.name_en as meal_name_en','restaurantmeals.description_ar as meal_description_ar'
                ,'restaurantmeals.description_en as meal_description_en','userordermeals.id as user_order_meal_id',
                'restaurants.name_ar as restaurant_name_ar','restaurants.name_en as restaurant_name_en',
            ]);
        $html ='';
        foreach ($order_details as $order_detail){
            $orders_adds_on  =  UserOrderMeal::where('userordermeals.id','=',$order_detail->user_order_meal_id)
                ->leftJoin('userordermealaddson','userordermeals.id','userordermealaddson.order_meal_id')//here for order adds on
            ->leftJoin('restaurantaddonelements','restaurantaddonelements.id','userordermealaddson.restaurant_add_on_element')//getting adds on
                ->get(['restaurantaddonelements.name_ar as addsOn_name_ar','restaurantaddonelements.name_en as addsOn_name_en']);
         $order_detail['order_adds_on'] = $orders_adds_on;

        }
        foreach ($order_details as $order_detail){
            $adds_on_name = [];
            foreach ($order_detail->order_adds_on as $order_adds_on ){
                if (App::getLocale() == 'en'){
                    $adds_on_name[] = $order_adds_on->addsOn_name_en;
                }else{
                    $adds_on_name[] = $order_adds_on->addsOn_name_ar;
                }
            }
            if (App::getLocale() == 'en'){
                $meal_name=  $order_detail->meal_name_en;
                $meal_description = $order_detail->meal_description_en;
                $restaurant_name = $order_detail->restaurant_name_en;
            }else{
                $meal_name=  $order_detail->meal_name_ar;
                $meal_description = $order_detail->meal_description_ar;
                $restaurant_name = $order_detail->restaurant_name_ar;
            }
            $meal_price = $order_detail->meal_price;
            $quantity = $order_detail->quantity;

            $html .= '<tr>
                <td>'.$meal_name.'</td>
                <td>'.$restaurant_name.'</td>
                <td>'.$meal_description.'</td>
                <td>'.$meal_price.'</td>
                <td>'.$quantity.'</td>
                <td>
            ';
            foreach ($adds_on_name as $add_on_name){
                $html.='
                '.$add_on_name.',';
            }
            $html .= '</td>
                 </tr>';
        }


        return response()->json(['html' => $html]);

    }

    /**
     * to change the order status to prepare
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function prepare($id)
    {
        $user_order = UserOrder::where('id','=',$id)->first();
        $user_order->update([
            'status'=>2,
        ]);
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'prepare_msg' => __('main.prepare_msg')]);
    }

    /**
     * to change the order status to prepare
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function on_way($id)
    {
        $user_order = UserOrder::where('id','=',$id)->first();
        $user_order->update([
            'status'=>3,
        ]);
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'on_way_msg' => __('main.on_way_msg')]);
    }
    /**
     * to change the order status to prepare
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delivered($id)
    {
        $user_order = UserOrder::where('id','=',$id)->first();
        $user_order->update([
            'status'=>4,
        ]);
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'delivered_msg' => __('main.delivered_msg')]);
    }

}
