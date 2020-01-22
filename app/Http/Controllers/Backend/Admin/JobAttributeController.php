<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Helper\MimeCheckRules;
use App\Model\JobAttributs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class JobAttributeController extends Controller
{

    private $except = [];
    /**
     * @var JobAttributs
     */
    private $attribute;

    public function __construct(JobAttributs $attribute)
    {
        $this->attribute = $attribute;
        $this->except =$attribute->types();

    }
    public function index($type){
        if(!$this->except->has($type))abort(401);
        $attributes = $this->attribute->where('type',$type)->paginate(20);
        $pt = $this->except[$type];
        return view('backend.admin.job_attr.index',compact('attributes','type','pt'));
    }
    public function store(Request $request,$type){

        if(!$this->except->has($type))abort(401);
        $this->validate($request,[
           'name'=>'required|max:191'
        ]);
        $attribute = new  $this->attribute;
        if(in_array($type,['functional_area'])){
            $this->validate($request,[
                'image'=>[new MimeCheckRules(['png','jpg'])]
            ]);
            if($request->has('image')){
                $path = 'assets/backend/image/attr/';

                $attribute->image = $type.time().'.'.$request->image->getClientOriginalExtension();
                Image::make($request->image)->save($path.$attribute->image);
            }
        }
        $attribute->name = $request->name;
        $attribute->type = $type;
        $attribute->status = $request->status?1:0;
        $attribute->save();
        return back()->with('success','Save successful');
    }
    public function update(Request $request,$type,$id){
        $this->validate($request,[
           'name'=>'required|max:191'
        ]);
        if($this->except->has($type) && $attribute=$this->attribute->where('type',$type)->where('id',$id)->first()){
            if(in_array($type,['functional_area'])){
                $this->validate($request,[
                    'image'=>[new MimeCheckRules(['png','jpg'])]
                ]);
                if($request->has('image')){
                    $path = 'assets/backend/image/attr/';
                    @unlink($path.$attribute->image);
                    $attribute->image = $type.time().'.'.$request->image->getClientOriginalExtension();
                    Image::make($request->image)->save($path.$attribute->image);
                }
            }
            $attribute->name = $request->name;
            $attribute->status = $request->status?1:0;
            $attribute->save();
            return back()->with('success','Update successful');
        }
        abort(401);
    }
    public function delete($type,$id){
         if($this->except->has($type) && $attribute=$this->attribute->where('type',$type)->where('id',$id)->first()){
             if(in_array($type,['functional_area'])){
                 $path = 'assets/backend/image/attr/';
                 @unlink($path.$attribute->image);
             }
             $attribute->delete();
             return back()->with('success','Delete successful');
         }
         abort(401);
    }
}
