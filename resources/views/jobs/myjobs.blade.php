@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Jobs</div>

                <div class="card-body">
                    @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{Session::get('message')}}
                    </div>
                    @endif
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
                                    <a class="jobdelete" deleteId="{{$job->id}}" style="text-decoration: none;" href="#">
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
    <script>
        $(document).ready(function () {
            $('.jobdelete').click(function () {
                var jobid = $(this).attr('deleteId');
                alertify.confirm('Job Delete', 'Are you sure! Delete the job', function () {
                    $.ajax({
                        /*headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },*/
                        //headers use for only post method
                        url: "{{url('/jobDelete/')}}" + "/" + jobid,
                        method: 'GET',
                        data: {},
                        success: function (result) {
                            location.reload();
                        }
                    });
                    alertify.success('Delete Successfully')
                }, function () {
                    alertify.error('Delete Cancel')
                });
            });
        });
    </script>
</div>
@endsection
