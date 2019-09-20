@extends('admin.dashboardlayout.app')

@section('title', "Dashboard")
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('admin.partial._messages')
    @role('studio')
    <!-- Main content -->

    {{--{{dd($studio->studio)}}--}}
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">

                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Performer Entry Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">

                                    <tr>
                                        <td><b>Title</b></td>
                                        <td> {{$paidPerformerEntry->title }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Audio</b></td>
                                        <td>
                                            @if($file = $paidPerformerEntry->file()->where('meta','Music')->first())
                                                <audio controls>
                                                    <source src="{{asset($file->url)}}" type="audio/mpeg">
                                                </audio>
                                                {{--<img src="{{asset($image->url) }}" class="" height="auto" width="50px">--}}
                                            @endif
                                        </td>

                                    </tr>
                                    <tr>
                                        <td><b>Division</b></td>
                                        <td>{{ $paidPerformerEntry->division}}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Average Age</b></td>
                                        <td>{{ $paidPerformerEntry->average_age }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Age Class</b></td>
                                        <td>{{ $paidPerformerEntry->age_class}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Performance Level</b></td>
                                        <td>{{ $paidPerformerEntry->performance_level}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Event Name</b></td>
                                        <td> {{ $paidPerformerEntry->competitionDetail->name}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label><input type="checkbox" value="{{ $paidPerformerEntry->exceed}}" name="exceed" id="exceedCheckbox" disabled>
                                                Please check here if an extended time of 2 minute is required for any entry that
                                                exceeds the standard time limit.Solo, Duos/Trios are not eligible for
                                                this option. Group and line production only.There is an additional charge of $3
                                                per dancer.
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label><input type="checkbox" value="{{ $paidPerformerEntry->donate}}" name="donate" disabled>
                                                Please check here if your studio would like to donate the cost of adjucationa
                                                award(for group only) to charity of your choice. Studios will receive a letter
                                                of recognnigation.
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label><input type="checkbox" value="{{ $paidPerformerEntry->prp}}" name="prop" disabled>
                                                Please check here if your studio would like to use a prop for this entry. A time
                                                limit of 2 minutes total will be allowed for both the set-up and a strike of
                                                props and is the sole responsibility of the studio.
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content-header -->

    @endrole


@endsection

