<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Model\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    /**
     * @var Package
     */
    private $package;

    public function __construct(Package $package)
    {

        $this->package = $package;
    }
    public function index(){
        $packages = $this->package->get();
        return view('backend.admin.package.index',compact('packages'));
    }
    public function store(Request $request){
        $this->validate($request,[
           'title'=>'required|max:191',
           'price'=>'required|numeric',
           'days'=>'required|integer',
           'num_of_listing'=>'required|integer',
           'package_for'=>'required',
        ]);
        $package = new  $this->package;
        $package->short_by = $this->package->max('short_by')+1;
        $package->title = $request->title;
        $package->price = $request->price;
        $package->days = $request->days;
        $package->num_of_listing = $request->num_of_listing;
        $package->package_for = $request->package_for;
        $package->status = $request->status?1:0;
        $package->save();
        return back()->with('success','Save successful');
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'title'=>'required|max:191',
            'price'=>'required|numeric',
            'days'=>'required|integer',
            'num_of_listing'=>'required|integer',
            'package_for'=>'required',
        ]);
        $package =   $this->package->findOrFail($id);
        $package->title = $request->title;
        $package->price = $request->price;
        $package->days = $request->days;
        $package->num_of_listing = $request->num_of_listing;
        $package->package_for = $request->package_for;
        $package->status = $request->status?1:0;
        $package->save();
        return back()->with('success','Update successful');
    }
}
