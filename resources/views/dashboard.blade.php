<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminLte1/plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminLte1/dist/css/adminlte.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('adminLte1/plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('adminLte1/plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    {{--<link rel="stylesheet" href="{{asset('adminLte1/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">--}}
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('adminLte1/plugins/datepicker/datepicker3.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('adminLte1/plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('adminLte1/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('admin.partial._navbar')

@include('admin.partial._sidebar')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

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
                <section class="content">
                    <div class="container-fluid">
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">My Registered Events </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>SN</th>
                                                <th>Title</th>
                                                <th>Division</th>
                                                <th>Average Age</th>
                                                <th>Age Class</th>
                                                <th>Performance Level</th>

                                            </tr>

                                            @foreach( $paidPerformerEntries as $key=>  $paidPerformerEntry)
                                                <tr>
                                                    <th>{{$key +1}}</th>
                                                    <td>
                                                        <a href="{{route('studio.dashboard.studioPerformerEntry',$paidPerformerEntry->id)}}">
                                                            {{  $paidPerformerEntry->title}}</a></td>
                                                    <td>{{ $paidPerformerEntry->division}}</td>
                                                    <td>{{ $paidPerformerEntry->average_age }}</td>
                                                    <td>{{ $paidPerformerEntry->age_class}}</td>
                                                    <td>{{ $paidPerformerEntry->performance_level}}</td>

                                                </tr>

                                            @endforeach



                                        </table>
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

                @role('super-admin')
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">All Events</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>SN</th>
                                                <th>Event Name</th>
                                                <th>Event Date</th>
                                                <th>Time</th>
                                                <th>Remaining time</th>
                                                <th>Event Location</th>
                                                <th>Rebate Date</th>
                                                <th>Last Date To Register</th>


                                            </tr>


                                            @foreach($competitionDetails as $key=>$competitionDetail)
                                                <tr>
                                                    <th>{{$key +1}}</th>
                                                    <td><a href="{{route('dashboard.eventPerformerEntry',$competitionDetail->id)}}">{{ $competitionDetail->name}}</a></td>
                                                    {{--<td>--}}
                                                        {{--<table>--}}

                                                            {{--@foreach($competitionDetail->eventDateTimes as $date)--}}
                                                                {{--<tr>--}}
                                                                    {{--<td>{{$date->date}}</td>--}}
                                                                    {{--<td>{{$date->time}}min</td>--}}
                                                                    {{--<td>{{$date->remainingTime}}min</td>--}}
                                                                {{--</tr>--}}
                                                            {{--@endforeach--}}

                                                        {{--</table>--}}
                                                    {{--</td>--}}
                                                    <td>
                                                        <table>
                                                            <?php $time = 0 ?>
                                                            <?php $remaining = 0 ?>
                                                            @foreach($competitionDetail->eventDateTimes as $date)
                                                                <tr>
                                                                    <?php $time += $date->time ?>
                                                                    <?php $remaining += $date->remainingTime ?>
                                                                    @if($loop->first)

                                                                        <?php
                                                                        echo substr( $date->date,0,strpos($date->date, '-'));
                                                                        ?>

                                                                    @endif

                                                                    @if($loop->last)

                                                                        <?php
                                                                        echo substr( $date->date,strpos($date->date, '-'),22);
                                                                        ?>

                                                                    @endif

                                                                </tr>
                                                            @endforeach

                                                        </table>
                                                    </td>
                                                    <td>{{$time}}</td>
                                                    <td>{{$remaining}}</td>
                                                    <td>{{ $competitionDetail->location}}</td>
                                                    <td>{{ $competitionDetail->rebate_date }}</td>
                                                    <td>{{ $competitionDetail->last_date_to_register}}</td>

                                                </tr>

                                            @endforeach

                                            <div class="text-center">
                                                {!! $competitionDetails->links(); !!}
                                            </div>

                                        </table>
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


                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">All Register Event</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        {{--<table class="table table-hover">--}}
                                            {{--<tr>--}}
                                                {{--<th>SN</th>--}}
                                                {{--<th>Studio Name</th>--}}
                                                {{--<th>Title</th>--}}
                                                {{--<th>Division</th>--}}
                                                {{--<th>Average Age</th>--}}
                                                {{--<th>Performance Level</th>--}}
                                                {{--<th>Event Name</th>--}}

                                            {{--</tr>--}}

                                            {{--@foreach($studios as $key=>$studio)--}}
                                                {{--<tr>--}}

                                                    {{--<td rowspan="{{count($studio->performerEntries->where('status','1'))+1}}">{{$studio->name}}</td>--}}


                                                {{--@foreach($studio->performerEntries->where('status','1') as $performerEntry)--}}

                                                    {{--<tr>--}}
                                                        {{--<td>--}}
                                                            {{--<a href="{{route('dashboard.performerEntry',[$performerEntry->id,$studio->id])}}">{{ $performerEntry->title}}</a>--}}
                                                        {{--</td>--}}
                                                        {{--<td>{{ $performerEntry->division}}</td>--}}
                                                        {{--<td>{{ $performerEntry->average_age }}</td>--}}
                                                        {{--<td>{{ $performerEntry->performance_level}}</td>--}}
                                                        {{--<td>--}}
                                                            {{--{{ $performerEntry->competitionDetail->name}}<br>--}}
                                                            {{--{{ $performerEntry->competitionDetail->eGroup}}--}}

                                                        {{--</td>--}}
                                                    {{--</tr>--}}
                                                {{--@endforeach--}}

                                            {{--@endforeach--}}

                                            {{--<div class="text-center">--}}
                                                {{--{!! $competitionDetails->links(); !!}--}}
                                            {{--</div>--}}

                                        {{--</table>--}}
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Studio Name</th>
                                                <th>Title</th>
                                            </tr>
                                            @foreach($studios as $key=>$studio)
                                                <tr>
                                                    <td>{{$studio->name}} <button onclick="save({{$key}})">Save</button></td>
                                                    <td>
                                                        <ul class="todo-list" onchange="{{$key}}save()">
                                                        @foreach($studio->performerEntries->where('status','1')->sortBy('orderBy') as $performerEntry)
                                                                <li data-id="{{$performerEntry->id}}">
                                                                            <!-- drag handle -->
                                                                    <span class="handle">
                                                                      <i class="fa fa-ellipsis-v"></i>
                                                                      <i class="fa fa-ellipsis-v"></i>
                                                                    </span>
                                                                            <!-- todo text -->
                                                                    <span class="text">
                                                                        <a href="{{route('dashboard.performerEntry',[$performerEntry->id,$studio->id])}}">{{ $performerEntry->title}}</a>
                                                                    </span>
                                                                </li>
                                                        @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <div class="text-center">
                                                {!! $competitionDetails->links(); !!}
                                            </div>

                                        </table>

                                        {{--<p id="demo"></p>--}}
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
                </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2019</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">

        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
    {{--var i;--}}
    {{--var length="{{$studios->count()}}";--}}
    {{--console.log(length);--}}
    // for (i = 0; i < length; i++) {
        function save(i) {
            console.log(i)
            var orders = [];
            $('ul.todo-list li').each(function(index,element) {
                // alert($(this).attr('data-id'))
                orders.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                });
            });
            console.log(orders);

            $.ajax({
                type: "POST",
                url: "{{ route('orderPerformerEntry') }}",
                data: {
                    orders: orders,
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    if (response.status == "success") {
                        alert(response);
                    } else {
                        console.log(response);
                    }
                },

            });
        }

    // }

</script>
{{--<!-- jQuery -->--}}
{{--<script src="{{asset('adminLte1/plugins/jquery/jquery.min.js')}}"></script>--}}
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminLte1/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('adminLte1/plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('adminLte1/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
{{--<!-- jvectormap -->--}}
{{--<script src="{{asset('adminLte1/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>--}}
{{--<script src="{{asset('adminLte1/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>--}}
<!-- jQuery Knob Chart -->
<script src="{{asset('adminLte1/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{asset('adminLte1/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('adminLte1/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('adminLte1/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('adminLte1/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminLte1/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminLte1/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('adminLte1/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminLte1/dist/js/demo.js')}}"></script>
</body>
</html>
