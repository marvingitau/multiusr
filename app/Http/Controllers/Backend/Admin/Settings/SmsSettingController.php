<?php

namespace App\Http\Controllers\Backend\Admin\Settings;

use App\Model\GeneralSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsSettingController extends Controller
{
    public function index(){
        return view('admin.settings.sms_api_index');

    }
    public function update(Request $request){
        $email_template = GeneralSetting::first();
        $email_template->sms_api = $request->sms_api;
        $email_template->save();
        return redirect()->back()->with('success','Update has been successful');
    }
}
