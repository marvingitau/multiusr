<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Helper\MimeCheckRules;
use App\Model\Social;
use App\Model\WebSetting as WS;
use App\Model\WebSettingItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class WebSettingController extends Controller
{
    /**
     * @var WebSettingItem
     */
    private $settingItem;

    public function __construct(WebSettingItem $settingItem)
    {
        $this->settingItem = $settingItem;
    }
    public function sectionEdit($page,$section){
        $view = 'backend.admin.web_settings.'.str_replace('-','_',$page).'.'.str_replace('-','_',$section);
        if(view()->exists($view)){
            return view($view,compact('page','section'));
        }
        abort(404);
    }
    public function sectionUpdate(Request $request,$page,$section){
        if($this->getSectionMethod($page,$section)){
            $method = '_'.str_replace('-','_',$page).'_'.str_replace('-','_',$section);

           return $this->$method($request);
        }
        $data = $request->all();
        unset($data['_token']);
        foreach ($data as $key=>$value){
            $field_name = str_replace('-','_',$page).'_'.str_replace('-','_',$section).'_'.$key;
            if(is_array($value)){
                if(array_key_exists('png',$value)){
                  $ext = 'png';
                }elseif (array_key_exists('jpg',$value)){
                    $ext = 'jpg';
                }elseif (array_key_exists('gif',$value)){
                    $ext = 'gif';
                }

                $image_path = 'assets/frontend/img/'.str_replace('-','_',$page).'/'.str_replace('-','_',$section).'/';
                $name = $key.'.'.$ext;
                $this->validate($request,[
                    $key.'.'.$ext=>[
                        function($attribute, $value, $fail) use ($request,$key,$ext) {
                            if(!in_array($request[$key][$ext]->getClientOriginalExtension(), [$ext])) {
                                return $fail('Only '.$ext.' files are allowed');
                            }
                        },'max:2048'
                    ],
                ]);
                if($ext === 'gif'){
                    $request[$key][$ext]->move($image_path,$name);
                }else{
                    Image::make($request[$key][$ext])->save($image_path.$name);
                }

            }else{
                $gs = WS::first();
                $gs->$field_name = $value;
                $gs->save();
            }
        }
        return redirect()->back()->with('success','Update successful');
    }
    private function getSectionMethod($page,$section,$request=null){
        $method = '_'.str_replace('-','_',$page).'_'.str_replace('-','_',$section);
        if (method_exists($this,$method)){
            return true;
        }
          return false;
    }

    /**
     * home_slider_area
     */
    private function _contact_all_section(Request $request){

        $height = '100%';
        $width = '100%';

        $iframe = preg_replace('/height="(.*?)"/i', 'height="' . $height .'"', $request->map);
        $iframe = preg_replace('/width="(.*?)"/i', 'width="' . $width .'"', $iframe);
        $ws = WS::first();
        $ws->contact_all_section_address = $request->address;
        $ws->contact_all_section_email = $request->email;
        $ws->contact_all_section_phone = $request->phone;
        $ws->contact_all_section_fax = $request->fax;
        $ws->contact_all_section_map =$iframe;
        if($request->has('contact_breadcrumb_image')){
            $this->validate($request,[
                'contact_breadcrumb_image.jpg'=>'required|image'
            ]);
            if(array_key_exists('jpg',$request->contact_breadcrumb_image)){
                $ext =  $request->contact_breadcrumb_image['jpg']->getClientOriginalExtension();
                if($ext !=='jpg'){
                    return back()->withError('Only jpg files are allowed');
                }
            }else{
                return back()->withError('Wrong image given');
            }
            $path = 'assets/frontend/img/contact/all_section/contact_breadcrumb_image.jpg';
            @unlink($path);
            Image::make($request->contact_breadcrumb_image['jpg'])->save($path);
        }
        $ws->save();
        return redirect()->back()->with('success','Update successful');
    }
    /**
     * Faq area
     */
    public function faqStore(Request $request){
        $faq = new $this->settingItem;
        $faq->type = 'faq';
        $faq->val_1 = $request->question;
        $faq->val_2 = $request->answer;
        $faq->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function faqUpdate(Request $request,$id){
        $faq =  $this->settingItem->findOrFail($id);
        $faq->val_1 = $request->question;
        $faq->val_2 = $request->answer;
        $faq->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function faqDelete($id){
        $this->settingItem->findOrFail($id)->delete();
        return redirect()->back()->with('success','Successful delete');
    }
    /**
     * Home Slider area
     */
    public function homeSliderStore(Request $request){
        $this->validate($request,[
            'image'=>['required',new MimeCheckRules(['jpg'])]
        ]);
        $table = new $this->settingItem;
        $table->type = 'slider';
        if($request->has('image')){
            $path = 'assets/frontend/img/home/slider_section/';

            $table->val_1 = 'slider'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->val_1);
        }
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function homeSliderUpdate(Request $request,$id){

        $this->validate($request,[
            'image'=>[new MimeCheckRules(['jpg'])]
        ]);
        $table =  $this->settingItem->findOrFail($id);
        if($request->has('image')){
            $path = 'assets/frontend/img/home/slider_section/';
            @unlink($path.$table->val_1);
            $table->val_1 = 'slider'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->val_1);
        }
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function homeSliderDelete($id){
        $table= $this->settingItem->findOrFail($id);
            $path = 'assets/frontend/img/home/slider_section/';
            @unlink($path.$table->val_1);

        $table->delete();
        return redirect()->back()->with('success','Successful delete');
    }
     /**
     * Home OverviewLeft area
     */
    public function homeOverviewLeftStore (Request $request){
        $table = new $this->settingItem;
        $table->type = 'overview_left';
        $table->val_1 = $request->icon;
        $table->val_2 = $request->number;
        $table->val_3 = $request->name;
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function homeOverviewLeftUpdate(Request $request,$id){
        $table =  $this->settingItem->findOrFail($id);
        $table->val_1 = $request->icon;
        $table->val_2 = $request->number;
        $table->val_3 = $request->name;
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function homeOverviewLeftDelete($id){
        $table= $this->settingItem->findOrFail($id);
        $table->delete();
        return redirect()->back()->with('success','Successful delete');
    }
     /**
     * Home OverviewRight area
     */
    public function homeOverviewRightStore (Request $request){
        $table = new $this->settingItem;
        $table->type = 'overview_right';
        $table->val_1 = $request->title;
        $table->val_2 = $request->details;
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function homeOverviewRightUpdate(Request $request,$id){
        $table =  $this->settingItem->findOrFail($id);
        $table->val_1 = $request->title;
        $table->val_2 = $request->details;
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function homeOverviewRightDelete($id){
        $table= $this->settingItem->findOrFail($id);
        $table->delete();
        return redirect()->back()->with('success','Successful delete');
    }
     /**
     * Home Team area
     */
    public function homeTeamStore (Request $request){

        $this->validate($request,[
            'image'=>[new MimeCheckRules(['jpg'])]
        ]);
        $table = new $this->settingItem;
        if($request->has('image')){
            $path = 'assets/frontend/img/home/team_section/';
            $table->val_1 = 'team'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->val_1);
        }
        $table->type = 'team';
        $table->val_2 = $request->name;
        $table->val_3 = $request->title;
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function homeTeamUpdate(Request $request,$id){
        $this->validate($request,[
            'image'=>[new MimeCheckRules(['jpg'])]
        ]);
        $table =  $this->settingItem->findOrFail($id);
        if($request->has('image')){
            $path = 'assets/frontend/img/home/team_section/';
            @unlink($path.$table->val_1);
            $table->val_1 = 'team'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->val_1);
        }
        $table->val_2 = $request->name;
        $table->val_3 = $request->title;
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function homeTeamDelete($id){
        $table= $this->settingItem->findOrFail($id);
        $table->delete();
        return redirect()->back()->with('success','Successful delete');
    }
     /**
     * Home Team social area
     */
    public function homeTeamSocialStore  (Request $request,$team_id){
        $table = new Social();
        $table->model_type = 'web_setting_item';
        $table->model_id = $team_id;
        $table->name = $request->name;
        $table->icon = $request->icon;
        $table->link = $request->link;
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function homeTeamSocialUpdate(Request $request,$team_id,$id){
        $table = Social::findOrFail($id);
        $table->name = $request->name;
        $table->icon = $request->icon;
        $table->link = $request->link;
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function homeTeamSocialDelete($team_id,$id){
        $table= Social::findOrFail($id);
        $table->delete();
        return redirect()->back()->with('success','Successful delete');
    }
    /**
     * Home TESTIMONIAL  area
     */
    public function homeTestimonialStore (Request $request){

        $this->validate($request,[
            'image'=>[new MimeCheckRules(['jpg','png'])]
        ]);
        $table = new $this->settingItem;
        if($request->has('image')){
            $path = 'assets/frontend/img/home/testimonial_section/';
            $table->val_1 = 'testimonial'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->val_1);
        }
        $table->type = 'testimonial';
        $table->val_2 = $request->quotation;
        $table->val_3 = $request->name;
        $table->val_4 = $request->title;
        $table->val_5 = $request->review;
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function homeTestimonialUpdate(Request $request,$id){
        $this->validate($request,[
            'image'=>[new MimeCheckRules(['jpg','png'])]
        ]);
        $table =  $this->settingItem->findOrFail($id);
        if($request->has('image')){
            $path = 'assets/frontend/img/home/testimonial_section/';
            @unlink($path.$table->val_1);
            $table->val_1 = 'testimonial'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->val_1);
        }
        $table->val_2 = $request->quotation;
        $table->val_3 = $request->name;
        $table->val_4 = $request->title;
        $table->val_5 = $request->review;
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function homeTestimonialDelete($id){
        $table= $this->settingItem->findOrFail($id);
        $path = 'assets/frontend/img/home/testimonial_section/';
        @unlink($path.$table->val_1);
        $table->delete();
        return redirect()->back()->with('success','Successful delete');
    }
    /**
     * Home TESTIMONIAL  area
     */
    public function homeWhyPeopleLikeStore (Request $request){

        $table = new $this->settingItem;
        $table->type = 'why_people_like';
        $table->val_1 = $request->name;
        $table->val_2 = $request->detail;
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function homeWhyPeopleLikeUpdate(Request $request,$id){
        $table =  $this->settingItem->findOrFail($id);
        $table->val_1 = $request->name;
        $table->val_2 = $request->detail;
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function homeWhyPeopleLikeDelete($id){
        $table= $this->settingItem->findOrFail($id);
        $table->delete();
        return redirect()->back()->with('success','Successful delete');
    }
    /**
     * Home Brand area
     */
    public function homeBrandStore(Request $request){
        $this->validate($request,[
            'image'=>['required',new MimeCheckRules(['png','jpg'])]
        ]);
        $table = new $this->settingItem;
        $table->type = 'brand';
        if($request->has('image')){
            $path = 'assets/frontend/img/home/brand_section/';

            $table->val_1 = 'brand'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->val_1);
        }
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function homeBrandUpdate(Request $request,$id){

        $this->validate($request,[
            'image'=>['required',new MimeCheckRules(['png','jpg'])]
        ]);
        $table =  $this->settingItem->findOrFail($id);
        $table->type = 'brand';
        if($request->has('image')){
            $path = 'assets/frontend/img/home/brand_section/';

            $table->val_1 = 'brand'.time().'.'.$request->image->getClientOriginalExtension();
            Image::make($request->image)->save($path.$table->val_1);
        }
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function homeBrandDelete($id){
        $table= $this->settingItem->findOrFail($id);
        $path = 'assets/frontend/img/home/brand_section/';
            @unlink($path.$table->val_1);
        $table->delete();
        return redirect()->back()->with('success','Successful delete');
    }
    /**
     * Home Social area
     */
    public function homeSocialStore (Request $request){
        $table = new $this->settingItem;
        $table->type = 'social';
        $table->val_1 = $request->name;
        $table->val_2 = $request->icon;
        $table->val_3 = $request->link;
        $table->val_4 = $request->status;
        $table->save();
        return redirect()->back()->with('success','Successful save');
    }
    public function homeSocialUpdate(Request $request,$id){
        $table =  $this->settingItem->findOrFail($id);
        $table->val_1 = $request->name;
        $table->val_2 = $request->icon;
        $table->val_3 = $request->link;
        $table->val_4 = $request->status;
        $table->save();
        return redirect()->back()->with('success','Successful updated');
    }
    public function homeSocialDelete($id){
        $table= $this->settingItem->findOrFail($id);
        $table->delete();
        return redirect()->back()->with('success','Successful delete');
    }
}
