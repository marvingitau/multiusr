<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Helper\MimeCheckRules;
use App\Model\City;
use App\Model\Country;
use App\Model\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class LocationController extends Controller
{
    /**
     * @var Country
     */
    private $country;
    /**
     * @var State
     */
    private $state;
    /**
     * @var City
     */
    private $city;

    public function __construct(Country $country,State $state,City $city)
    {
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
    }
    public function index(){
        $countries = $this->country->orderBy('short_by','ASC')->get();
        return view('backend.admin.location.country',compact('countries'));
    }
    public function store(Request $request){
        $this->validate($request,[
           'name'=>'required|unique:countries|max:191',
            'flag'=>[new MimeCheckRules(['png'])]
        ]);
        $country =new $this->country;
        $country->short_by = $this->country->max('short_by')+1;
        $country->name = $request->name;
        $country->full_name = $request->full_name;
        $country->status = $request->status?1:0;
        if($request->hasFile('flag')){
            $country->flag = 'flag_'.time().'.png';
            $path = 'assets/backend/image/flag/';
            Image::make($request->flag)->save($path.$country->flag);
        }
        $country->save();
        return back()->withSuccess('Save successful');
    }
    public function update(Request $request,$id){
        $this->validate($request,[
           'name'=>"required|unique:countries,name,$id|max:191"
        ]);
        $country = $this->country->findOrFail($id);
        $country->name = $request->name;
        $country->full_name = $request->full_name;
        $country->status = $request->status?1:0;
        if($request->hasFile('flag')){
            $path = 'assets/backend/image/flag/';
            @unlink($path.$country->flag);
            $country->flag = 'flag_'.time().'.png';
            Image::make($request->flag)->save($path.$country->flag);
        }
        $country->save();
        return back()->withSuccess('Update successful');
    }

    public function stateIndex($country_id){
        $country = $this->country->findOrFail($country_id);
        $states = $country->state()->get();
        return view('backend.admin.location.state',compact('country','states'));
    }

    public function stateStore(Request $request,$country_id){
        $this->validate($request,[
            'name'=>'required|max:191',
        ]);
        $state =new $this->state;
        $state->name = $request->name;
        $state->short_by = $this->state->where('country_id',$country_id)->max('short_by')+1;
        $state->country_id =$country_id;
        $state->status = $request->status?1:0;
        $state->save();
        return back()->withSuccess('Save successful');
    }

    public function stateUpdate(Request $request,$country_id,$id){
        $this->validate($request,[
            'name'=>'required|max:191',
        ]);
        $state =$this->state->findOrFail($id);
        if($state->country_id != $country_id)abort(401);
        $state->name = $request->name;
        $state->status = $request->status?1:0;
        $state->save();
        return back()->withSuccess('Update successful');
    }

    public function cityIndex($state_id){
        $state = $this->state->findOrFail($state_id);
        $cities = $state->city()->get();
        return view('backend.admin.location.city',compact('state','cities'));
    }

    public function cityStore(Request $request,$state_id){
        $this->validate($request,[
            'name'=>'required|max:191',
        ]);
        $city =new $this->city;
        $city->name = $request->name;
        $city->short_by = $this->city->where('state_id',$state_id)->max('short_by')+1;
        $city->state_id =$state_id;
        $city->status = $request->status?1:0;
        $city->save();
        return back()->withSuccess('Save successful');
    }

    public function cityUpdate(Request $request,$state_id,$id){
        $this->validate($request,[
            'name'=>'required|max:191',
        ]);
        $city =$this->city->findOrFail($id);
        if($city->state_id != $state_id)abort(401);
        $city->name = $request->name;
        $city->status = $request->status?1:0;
        $city->save();
        return back()->withSuccess('Update successful');
    }
    public function shortable(Request $request,$type){
        if(in_array($type,['country','state','city'])){
            foreach ($request->sectionsid as $key=>$v){
                $data =  $this->$type->where('id',$v)->first();
                $data->short_by = $key+1;
                $data->save();
            }
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'error']);

    }
}
