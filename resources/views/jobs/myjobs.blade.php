@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Jobs</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <th></th>
                            <th>Employment Type</th>
                            <th>Address</th>
                            <th>Publish Date</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <td>
                                        <img src="{{asset('avatar/man.jpg')}}" width="80">
                                    </td>
                                    <td>
                                        Position: {{$job->position}}
                                        <br>
                                        {{$job->type}}
                                    </td>
                                    <td>
                                        Address: {{$job->address}}
                                    </td>
                                    <td>
                                        Date: {{$job->created_at->diffForHumans()}}
                                    </td>
                                    <td>
                                        <!--<a href="{{route('jobs.show',[$job->id,$job->slug])}}">
                                            <button class="btn btn-success btn-sm">Apply</button>
                                        </a>-->
                                        <a style="text-decoration: none;" href="{{url('jobedit',[$job->id])}}">
                                            <i class='fas fa-edit' style='font-size:20px'></i>
                                        </a> 
                                        <a style="text-decoration: none;" href="{{url('jobedit',[$job->id])}}">
                                            <i class='fas fa-trash-alt' style='font-size:20px;color: red;'></i>
                                        </a>	
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
