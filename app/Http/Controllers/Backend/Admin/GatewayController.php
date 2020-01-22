<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Model\Gateway;
use App\Model\Payment;
use Illuminate\Http\Request;
use Image;
use App\Http\Controllers\Controller;
class GatewayController extends Controller
{
    public function index(){
        $items = Gateway::all();
        return view('backend.admin.payment.gateway', compact('items'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'gateimg' => 'image|mimes:jpg,jpeg,png|max:2048'
        ],
            [
                'gateimg.image' => 'Gateway image should be an image',
                'gateimg.mimes' => 'Gateway image support only jpeg, jpg, png type file',
                'gateimg.max' => 'Gateway image size is too large',
            ]);
        $excp = $request->except('_token', 'gateimg', 'status');
        if($request->hasFile('gateimg'))
        {
            $path = 'assets/backend/image/gateway/';
            @unlink($path. $id.'.jpg');
            $image = $id . '.jpg';
            Image::make($request->file('gateimg')->getRealPath())->resize(800, 800)->save($path. $image);
        }
        $staus = $request->status =="1" ?1:0 ;
        Gateway::findOrFail($id)->update($excp + ['status' => $staus]);
        session()->flash('success', 'Gateway Updated');
        return back();
    }

    public function paymentLog(){
        $logs = Payment::whereStatus(1)->latest()->paginate(20);
        return view('backend.admin.payment.payment_log', compact('logs'));
    }


}
