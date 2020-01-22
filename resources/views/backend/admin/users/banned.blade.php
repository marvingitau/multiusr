@extends('backend.master')

@section('title',"Users")

@section('content')

    <div class="row">

        <div class="col-md-12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="card light bordered">

                <div class="card-header bg-white">

                    <h5>Job Applicants</h5> 
                    <form role="form" action="{{route('download.csv')}}" method="POST">
                        @csrf
                        <button type="submit">Down csv </button>
                    </form>

                </div>

                <div class="card-body">
                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th>Full name </th>
                                {{-- <th>Position</th> --}}

                            <!-- <form action="" method="get">
                                   <select name="filterValue" id="filters" onchange="this.form.submit();">
                                     <option value="">Other Filters</option>
                                     <option value="experince"> Experience </option>
                                     <option value="career_level"> Career Level </option>
                                     <option value="degree_level"> Degree Level </option>
                                     <option value="skills"> Skills </option>
                                     <option value="type"> Job Type </option>
                                     <option value="experince"> Experience </option>
                                   </select>
                                </form> --> 

                                <th>Job Experience</th>
                                <th>Career Level</th>
                                <th>Department Area</th>
                                <th>Education</th>
                                <th>Job</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($joinedData as $key => $value)
                            <tr>
                                <td scope="row">
                                    {{ $value->first_name }} {{$value->last_name }}
                                </td>
                                {{-- <td>
                                    {{ \App\Model\PostJob::whereId($value->job_id)->value('title') }} 
                                </td> --}}
                                <td>
                                    {{ \App\Model\JobAttributs::whereId($value->experience_id)->value('name') }} 
                                </td>
                                <td>
                                    {{ \App\Model\JobAttributs::whereId($value->career_level_id)->value('name') }}
                                </td>
                                <td> 
                                    {{ \App\Model\JobAttributs::whereId($value->functional_area_id)->value('name') }}
                                </td>
                                <td> 
                                    {{ $value->name }}
                                    {{-- //{{\App\Model\JobAttributs::whereId($value->degree_level_id)->value('name') }} --}}
                                </td>

                                <td> 
                                    {{ $value->title }}
                                    {{-- //{{\App\Model\JobAttributs::whereId($value->degree_level_id)->value('name') }} --}}
                                </td>
                               
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
                </div>

            </div><!-- row -->

        </div>

    </div>

@endsection



