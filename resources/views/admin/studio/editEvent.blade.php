@extends('admin.dashboardlayout.app')

@section('title', "Studio Performer")
@section('content')
    {{--{{dd($studios)}}--}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Event</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('admin.partial._messages')
    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Entry Event</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('updateEvent',$performerEntry_Id)}}" method="POST"
                              enctype="multipart/form-data" name="first">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            @include('admin.partial._messages')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Event</label>

                                        <select class="form-control" name="competitionDetail_id">
                                            <option>Please Select a Event</option>
                                            <optgroup label="Regional">
                                                @foreach( $competitionDetails->where('eGroup','Regional') as $competitionDetail)
                                                    <option value="{{$competitionDetail->id}}">{{$competitionDetail->name}}( <b>
                                                            @foreach($competitionDetail->eventDateTimes()->get() as $date )
                                                                @if ($loop->first)
                                                                    {{$date->date}}
                                                                @endif

                                                                @if ($loop->last)

                                                                @endif

                                                            @endforeach
                                                        </b> )</option>
                                                @endforeach
                                            </optgroup>

                                            <optgroup label="National">
                                                @foreach( $competitionDetails->where('eGroup','National') as $competitionDetail)
                                                    <option value="{{$competitionDetail->id}}">{{$competitionDetail->name}}( <b>
                                                            @foreach($competitionDetail->eventDateTimes()->get() as $date )
                                                                @if ($loop->first)
                                                                    {{$date->date}}
                                                                @endif

                                                                @if ($loop->last)

                                                                @endif

                                                            @endforeach
                                                        </b> )</option>
                                                @endforeach
                                            </optgroup>
                                        </select>




                                </div>




                            </div>
                            <button type="submit" name="SUBMIT" class="btn btn-primary pull-right">Add Entry</button>


                        </form>
                        {{--form end--}}
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content-header -->

@endsection
