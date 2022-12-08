<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerEditRequest;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('order')->get();
        $orders = Banner::select('order')->orderBy('order')->get();
        return view('banner.index')
            ->with('banners',$banners)
            ->with('orders',$orders);
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
     * @param BannerRequest $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $banner_url = $this->call_uploaded_photo($request,'image');
        $banners = Banner::select('order')->orderBy('order')->get();
        $last_banner = $banners->last();
        $banner=Banner::create([
            'banner_url'=>$banner_url,
        ]);
        if(!$last_banner){
            $banner->update([
                'order'=>1,
            ]);
        }else{
            $banner->update([
                'order'=>$last_banner->order+1,
            ]);
        }
        if($banner_url){
            Session::flash('uploaded', __('main.uploaded'));
        }else{
            Session::flash('not_uploaded',  __('main.not_uploaded'));
        }
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'create_banner_msg' => __('main.create_banner_msg')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BannerEditRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BannerEditRequest $request, $id)
    {
//        dd($request->all());
        $alternative =  Banner::where('order','=',$request->order)->first();
        $selected_banner = Banner::where('id','=',$id)->first();

        if(!$selected_banner){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'not_found_msg_banner' => __('main.not_found_msg_banner')]);
        }
        if(!$alternative){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'not_found_msg_banner' => __('main.not_found_msg_banner')]);
        }

        $alt_order = $alternative->order;
        if ($request->image_edit != null){
            $banner = $this->call_uploaded_photo($request,'image_edit');
            $selected_banner->update([
                'banner_url'=>$banner
            ]);
            if($banner){
                Session::flash('uploaded2', __('main.uploaded'));
            }else{
                Session::flash('not_uploaded2',  __('main.not_uploaded'));
            }
        }
        $alternative->update([
            'order'=>$selected_banner->order
        ]);
        $selected_banner->update([
            'order'=>$alt_order,
        ]);
        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'update_banner_msg' => __('main.update_banner_msg')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $selected_banner = Banner::where('id','=',$id)->first();
        if(!$selected_banner){
            return redirect()->back()->with(['error_title' => __('main.error_title'),
                'not_found_msg_banner' => __('main.not_found_msg_banner')]);
        }
        $selected_banner->delete();
        $counter=0;
        $banners_orders = Banner::select('*')->orderBy('order')->get();
        foreach ($banners_orders as $banners_order ){
            $counter=$counter+1;
            $banners_order->update([
                'order'=>$counter
            ]);
        }

        return redirect()->back()->with(['success_title' => __('main.success_title'),
            'delete_banner_msg' => __('main.delete_banner_msg')]);
    }
}
