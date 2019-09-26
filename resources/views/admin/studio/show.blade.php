@extends('admin.dashboardlayout.app')

@section('title', "Studio Performer")
@section('content')
    {{--{{dd($studios)}}--}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Studio Performer</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('admin.partial._messages')
    <!-- Main content -->

    {{--{{dd($studioPerformers)}}--}}
    <section class="content">
        <div class="container-fluid">

            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <span style="float: left">
                                   <h3 class="card-title">Studio Details</h3>
                            </span>
                            <span style="float: right">
                                <a href="{{route('studioPDF',$studio->id)}}"  target="_blank">
                                <button type="button" class="btn btn-primary" >

                                        Generate Studio Details

                                </button>
                            </a>
                            </span>


                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <tr>
                                            <td><b>Studio Name</b></td>
                                            <td>{{$studio->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td>{{$studio->email}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Register IP</b></td>
                                            <td>{{$studio->ip}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Faculty</b></td>
                                            <td>{{$studio->studio->faculty}}</td>
                                        </tr>


                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <tr>
                                            <td><b>Title</b></td>
                                            <td>{{$studio->studio->title}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Director Name</b></td>
                                            <td>{{$studio->studio->director_name}}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Studio Phone Number</b></td>
                                            <td>{{$studio->studio->studio_phone}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Cell Phone Number</b></td>
                                            <td>{{$studio->studio->cell_phone}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td>{{$studio->studio->address}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>City</b></td>
                                            <td>{{$studio->studio->city}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>State</b></td>
                                            <td>{{$studio->studio->state}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Zip</b></td>
                                            <td>{{$studio->studio->zip}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- /.row -->

        @if (!$studioPerformers->where('status','1')->isEmpty())
            <!-- /.row -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            {{--<a href="{{route('feature.create')}}">--}}
                            {{--<button type="button" class="btn btn-primary pull-right">Add Feature</button>--}}
                            {{--</a>--}}
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Studio Performer Entries</h3>
                                    </div>


                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>SN</th>
                                                <th>Title</th>
                                                <th>Audio</th>
                                                <th>Division</th>
                                                <th>Average Age</th>
                                                <th>Age Class</th>
                                                <th>Performance Level</th>
                                                <th>Event Name</th>
                                            </tr>

                                            @foreach($studioPerformers->where('status','1') as $key=>$studioPerformer)
                                                {{--{{dd($studioPerformer->competitionDetail)}}--}}
                                                <tr>
                                                    <th>{{ $key +1}}</th>
                                                    <td>{{ $studioPerformer->title}}</td>
                                                    <td>
                                                        @if($file = $studioPerformer->file()->where('meta','Music')->first())
                                                            <audio controls>
                                                                <source src="{{asset($file->url)}}" type="audio/mpeg">
                                                            </audio>
                                                            {{--<img src="{{asset($image->url) }}" class="" height="auto" width="50px">--}}
                                                        @endif
                                                    </td>
                                                    <td>{{ $studioPerformer->division}}</td>
                                                    <td>{{ $studioPerformer->average_age }}</td>
                                                    <td>{{ $studioPerformer->age_class}}</td>
                                                    <td>{{ $studioPerformer->performance_level}}</td>
                                                    <td>{{ $studioPerformer->competitionDetail->name}}</td>

                                                    <td><button><a href="{{route('editEvent',$studioPerformer->id)}}">Edit</a></button></td>
                                                </tr>

                                                @endforeach



                                        </table>
                                        <div class="text-center">
                                            {{--{!! $studios->links(); !!}--}}
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div><!-- /.row -->
                    </div>
                </section>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">No Performer Entries</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content-header -->

@endsection
