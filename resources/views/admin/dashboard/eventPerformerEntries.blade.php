@extends('admin.dashboardlayout.app')

@section('title', "Performance Category")
@section('content')
    <section class="content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <span style="float: left">
                                   <h3 class="card-title">Studio Details</h3>
                            </span>
                            <span style="float: right;padding-right: 20px;">
                                <a href="{{route('downloadEventMusic',$event->id)}}"  target="_blank">
                                <button type="button" class="btn btn-primary" >

                                        Download music file
                                </button>
                            </a>
                            </span>
                        </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tr>
                                <td><b>Event Name:</b></td>
                                <td>{{$event->name}}</td>
                            </tr>
                            <tr>
                                <td><b>Event Type:</b></td>
                                <td>{{$event->eGroup}}</td>
                            </tr>
                            <tr>
                                <td><b>Event Location:</b></td>
                                <td>{{$event->location}}</td>
                            </tr>


                        </table>
                    </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    @include('admin.partial._messages')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if (!$performerEntries->isEmpty())
                            @foreach($performanceLevels as $level)

                                @if (!$performerEntries->where('performance_level',$level)->isEmpty())
                                <div class="card-header">
                                    <h3 class="card-title">Event Performer Entry ({{$level}})</h3>
                                </div>


                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Performer Entry Title</th>
                                            <th>Studio Name</th>
                                            <th>Division</th>
                                            <th>Performance Level </th>
                                        </tr>
                                        {{--{{dd($performerEntries)}}--}}


                                            @foreach($performerEntries->where('performance_level',$level) as $pEntry)
                                                <tr>

                                                    <td>
                                                        <a href="{{route('dashboard.performerEntry',[$pEntry->id,$pEntry->user->id])}}">{{$pEntry->title}}</a>
                                                    </td>
                                                    <td>{{$pEntry->user->name}}</td>
                                                    <td>{{$pEntry->division}}</td>
                                                    <td>{{$pEntry->performance_level}}</td>
                                                </tr>
                                            @endforeach


                                    </table>

                                </div>
                                @endif
                                <!-- /.card-body -->
                            @endforeach
                        @else
                            <div class="card-header">
                                <h3 class="card-title">No Performer Entry</h3>
                            </div>
                        @endif
                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content-header -->
@endsection
