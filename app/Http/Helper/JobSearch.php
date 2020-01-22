<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/27/2019
 * Time: 1:54 PM
 */

namespace App\Http\Helper;


use Illuminate\Support\Collection;

class JobSearch
{
    public function filter($query,Collection $filter){
        foreach ($filter as $key=>$filter_value){
            $method = '_'.$key;
            if(method_exists($this,$method)){
                $query = $this->$method($query,$filter_value);
            }
        }
        return $query;
    }

    public function _experience($query,$filter){
        return $query->whereIn('experience_id',$filter);
    }

    public function _type($query,$filter){
        return $query->whereIn('job_type_id',$filter);
    }

    public function _career_level($query,$filter){
        return $query->whereIn('career_level_id',$filter);
    }

    public function _degree_level($query,$filter){
        return $query->whereIn('degree_level_id',$filter);
    }

    public function _shift($query,$filter){
        return $query->whereIn('job_shift_id',$filter);
    }

    public function _skills($query,$filter){
        return $query->whereHas('skill',function ($q) use($filter){
            $q->whereIn('skill_id',$filter);
        });
    }

    public function _industry($query,$filter){
        return $query->whereHas('employer',function ($q) use($filter){
            $q->whereIn('industry_id',$filter);
        });
    }

    public function _company($query,$filter){
        return $query->whereIn('employer_id',$filter);
    }

    public function _functional_area($query,$filter){
        return $query->whereIn('functional_area_id',$filter);
    }

    public function _country($query,$filter){
        return $query->whereIn('country_id',$filter);
    }
    public function _state($query,$filter){
        return $query->whereIn('state_id',$filter);
    }
    public function _city($query,$filter){
        return $query->whereIn('city_id',$filter);
    }
    public function _keyword($query,$filter){
        if(is_array($filter)){
            $filter = $filter[0];
        }
        return $query->where(function ($q) use($filter){
            $q->orWhere('title','LIKE',"%$filter%")
                ->orWhereHas('skill',function ($q) use($filter){
                    $q->where('type','skills')->where('name','LIKE',"%$filter%");
                });
        });
    }
}