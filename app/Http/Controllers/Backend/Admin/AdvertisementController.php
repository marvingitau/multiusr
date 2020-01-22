<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Model\Advertisement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class AdvertisementController extends Controller
{


    /**
     * @var Advertisement
     */
    private $advertisement;

    public function __construct(Advertisement $advertisement){
        $this->advertisement = $advertisement;
    }

    public function index(){
        $advertisements =$this->advertisement->paginate(20);
        return view('backend.admin.advertisement.index',compact('advertisements'));
    }
    public function create(){
        return view('backend.admin.advertisement.create');
    }
    public function store(Request $request){
        $allowedExts = array('jpg');

        if($request->size == 1){
            $image_size = 'dimensions:max_width=300,max_height=250';
        }elseif ($request->size == 2){
            $image_size = 'dimensions:max_width=728,max_height=90';
        }elseif ($request->size == 3){
            $image_size = 'dimensions:max_width=300,max_height=600';
        }

        $this->validate($request,[
            'email'=>'email',
            'image' => ['image',$image_size,
                function($attribute, $value, $fail) use ($request, $allowedExts) {
                    $ext = $request->file('image')->getClientOriginalExtension();
                    if(!in_array($ext, $allowedExts)) {
                        return $fail('Only jpg files are allowed');
                    }
                }
            ]
        ]);
        $advertisements = new $this->advertisement;
        $advertisements->type = $request->type;
        $advertisements->size = $request->size;
        if($request->type == 1){
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = 'add_'.time(). '.jpg';
                $location = 'assets/backend/image/advertisement/' . $fileName;
                Image::make($image)->save($location);
                $advertisements->image = $fileName;
            }
            $advertisements->redirect_url = $request->redirect_url;
        }
        if($request->type == 2){
            $advertisements->script = nl2br($request->script);
        }
        $advertisements->is_active = $request->has('is_active')?1:0;
        $advertisements->save();

        return redirect()->back()->with('success','advertisements has been create successful');
    }
    public function adClick($id){
       $add = $this->advertisement->findOrFail($id);
       $add->click =$add->click+1;
       $add->save();
        return response($add);
    }
    public function view($id){
        $advertisement = $this->advertisement->findOrFail($id);

        if (!empty($advertisement)) {

            if($advertisement->size == 2){
                $maxwd = '728px';
            } else{
                $maxwd = '300px';
            }

            if ($advertisement->type == 1) {
                $data = '<a target="_blank" href="'.$advertisement->url.'" onclick="increaseAdView('.$advertisement->id.')"><img src="'.asset('/assets/admin/img/advertisement/'.$advertisement->image).'" alt="Ad" style="width:100%; max-width:'.$maxwd.';"/></a>';
            }
            if($advertisement->type == 2) {
                $data = $advertisement->script;
            }
        } else {
            $data = '';
        }
        return view('backend.admin.advertisement.view',compact('advertisement','data'));
    }
    public function edit($id){
        $advertisement = $this->advertisement->findOrFail($id);
        return view('backend.admin.advertisement.edit',compact('advertisement'));
    }
    public function update(Request $request,$id){
        $allowedExts = array('jpg');

        if($request->size == 1){
            $image_size = 'dimensions:max_width=300,max_height=250';
        }elseif ($request->size == 2){
            $image_size = 'dimensions:max_width=728,max_height=90';
        }elseif ($request->size == 3){
            $image_size = 'dimensions:max_width=300,max_height=600';
        }

        $this->validate($request,[
            'email'=>'email',
            'image' => ['image',$image_size,
                function($attribute, $value, $fail) use ($request, $allowedExts) {
                    $ext = $request->file('image')->getClientOriginalExtension();
                    if(!in_array($ext, $allowedExts)) {
                        return $fail('Only jpg files are allowed');
                    }
                }
            ]
        ]);
        $advertisements = $this->advertisement->findOrFail($id);
        $advertisements->type = $request->type;
        $advertisements->size = $request->size;
        if($request->type == 1){
            if($request->hasFile('image')) {
                @unlink('assets/backend/image/advertisement/' .$advertisements->image);
                $image = $request->file('image');
                $fileName = 'add_'.time(). '.jpg';
                $location = 'assets/backend/image/advertisement/' . $fileName;
                Image::make($image)->save($location);
                $advertisements->image = $fileName;
            }
            $advertisements->redirect_url = $request->redirect_url;
        }
        if($request->type == 2){
            $advertisements->script = nl2br($request->script);
        }
        $advertisements->is_active = $request->has('is_active')?1:0;
        $advertisements->save();

        return redirect()->back()->with('success','Advertisements has been updated successful');
    }
}
