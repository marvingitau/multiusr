

@extends('backend.employer.master')
@section('title','Followers')
@section('content')
    <div class="card ">
        <div class="card-body border-bottom">
            <h4>Followers</h4>
        </div>
        <div class="card-body">
            <table class="w-100">
                <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Title</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-square btn-outline-tsk dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ACTION
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">CANDIDATES SHORT LIST</a>
                                <a class="dropdown-item" href="#">CANDIDATES LIST</a>
                                <a class="dropdown-item" href="#">EDIT</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-square btn-outline-tsk dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ACTION
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">CANDIDATES SHORT LIST</a>
                                <a class="dropdown-item" href="#">CANDIDATES LIST</a>
                                <a class="dropdown-item" href="#">EDIT</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-square btn-outline-tsk dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ACTION
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">CANDIDATES SHORT LIST</a>
                                <a class="dropdown-item" href="#">CANDIDATES LIST</a>
                                <a class="dropdown-item" href="#">EDIT</a>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
