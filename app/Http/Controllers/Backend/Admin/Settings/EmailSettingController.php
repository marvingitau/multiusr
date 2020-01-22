<?php

namespace App\Http\Controllers\Backend\Admin\Settings;

use App\Model\GeneralSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailSettingController extends Controller
{
    public function index(){
        return view('backend.admin.settings.email_template.index');

    }
    public function update(Request $request){
        $email_template = GeneralSetting::first();
        $email_template->sender_email = $request->sender_email;
        $email_template->email_message = $request->email_message;
        $email_template->save();
        return redirect()->back()->with('success','Update has been successful');
    }
}
