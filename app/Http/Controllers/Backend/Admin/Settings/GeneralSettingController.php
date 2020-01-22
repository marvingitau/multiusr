<?php

namespace App\Http\Controllers\Backend\Admin\Settings;

use App\Model\CodeManager;
use App\Model\GeneralSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralSettingController extends Controller
{
    public function generalSetting(){
        $setting_data = GeneralSetting::first();
        return view('backend.admin.setting.general_setting',compact('setting_data'));
    }
    public function generalSettingUpdate(Request $request){
        $this->validate($request,[
            'per_point_rate'=>'nullable|numeric',
            'p_p_f_s_a'=>'nullable|numeric',
        ]);
        $general_setting = GeneralSetting::first();
        $general_setting->title = $request->title;
        $general_setting->color = $request->color;
        $general_setting->cur = $request->cur;
        $general_setting->cur_sym = $request->cur_sym;
        $general_setting->fb_login = $request->has('fb_login')?1:0;
        $general_setting->fb_client_id = $request->fb_client_id;
        $general_setting->fb_client_secret = $request->fb_client_secret;
        $general_setting->google_login = $request->has('google_login')?1:0;
        $general_setting->google_client_id = $request->google_client_id;
        $general_setting->google_client_secret = $request->google_client_secret;
        $general_setting->en = $request->has('en')?1:0;
        $general_setting->ev = $request->has('ev')?1:0;
        $general_setting->mn = $request->has('mn')?1:0;
        $general_setting->mv = $request->has('mv')?1:0;
        $general_setting->reg = $request->has('reg')?1:0;
      $general_setting->save();
      return redirect()->back()->with('success','Update Successful');
    }

    public function emailSetting(){
        return view('backend.admin.setting.email_setting');
    }
    public function emailSettingUpdate(Request $request){
        $email_template = GeneralSetting::first();
        $email_template->sender_email = $request->sender_email;
        $email_template->email_message = $request->email_message;
        $email_template->save();
        return redirect()->back()->with('success','Update has been successful');
    }
    public function smsSetting(){
        return view('backend.admin.setting.sms_setting');
    }
    public function smsSettingUpdate(Request $request){
        $email_template = GeneralSetting::first();
        $email_template->sms_api = $request->sms_api;
        $email_template->save();
        return redirect()->back()->with('success','Update has been successful');
    }
    public function logoAndFavicon(){
        return view('backend.admin.setting.logo_and_favicon');
    }
    public function logoAndFaviconUpdate(Request $request){
        $this->validate($request,[
            'logo'=>'image|mimes:png',
            'favicon'=>'image|mimes:png'
        ]);
        if($request->hasFile('logo')){
            $site_logo_image = $request->file('logo');
            $site_logo_image_ext = $site_logo_image->getClientOriginalExtension();
            $site_logo_image->move('assets','logo.'.$site_logo_image_ext);
        }
        if($request->hasFile('favicon')){
            $site_favicon_image = $request->file('favicon');
            $site_favicon_image_ext = $site_favicon_image->getClientOriginalExtension();
            $site_favicon_image->move('assets','favicon.'.$site_favicon_image_ext);
        }
        return redirect()->back()->with('success','Update has been successful');
    }

}
