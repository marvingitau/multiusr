<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/24/2019
 * Time: 4:46 PM
 */

namespace App\Http\Helper;


use App\Model\City;
use App\Model\Country;
use App\Model\State;

trait LocationResource
{
    public function makeLocation($country=null,$state=null,$city=null){

        $country = Country::where('id',$country)->first();
        $state = State::where('id',$state)->where('country_id',optional($country)->id)->first();

        $city = City::where('id',$city)->where('state_id',optional($state)->id)->first();

        $result['country']=[
            'option'=>Country::where('status',1)->orderBy('short_by','ASC')->get(),
            'selected'=>$country
        ];
        $result['state']=[
            'option'=>State::where('country_id',optional($country)->id)->orderBy('short_by','ASC')->get(),
            'selected'=>$state
        ];
        $result['city']=[
            'option'=>City::where('state_id',optional($state)->id)->orderBy('short_by','ASC')->get(),
            'selected'=>$city
        ];
        return $result;
    }
}