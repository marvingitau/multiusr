@extends('backend.master')
@section('title',"Payment Log")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card light bordered">
                <div class="card-header bg-tsk text-white">
                    <h5>Payment Log</h5>
                </div>
                <div class="card-body p-0">

                    <table class="table table-sm table-striped table-bordered table-hover order-column">
                        <thead>
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                User
                            </th>
                            <th>
                                Method
                            </th>
                            <th>
                                Trx
                            </th>
                            <th class="text-right">
                                Amount
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>
                                    {{$log->created_at}}
                                </td>
                                <td>
                                    <a href="{{route('admin.employer.view',optional($log->user)->id)}}">{{optional($log->user)->username}}</a>
                                </td>
                                <td>
                                    {{$log->gateway->name}}
                                </td>
                                <td>
                                    {{$log->trx}}
                                </td>
                                <td class="text-right">
                                   {{general_setting()->cur_sym}} {{number_format($log->amount)}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div><!-- row -->
        </div>
    </div>
@endsection

