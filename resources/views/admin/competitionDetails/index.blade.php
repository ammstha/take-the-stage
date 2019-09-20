<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Advanced form elements</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('adminLte1/plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('adminLte1/plugins/iCheck/all.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{asset('adminLte1/plugins/colorpicker/bootstrap-colorpicker.min.css')}}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{asset('adminLte1/plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminLte1/plugins/select2/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminLte1/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
@include('admin.partial._navbar')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('admin.partial._sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Competition Details</h1>
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


                    <a href="{{route('competitionDetail.create')}}">
                        <button type="button" class="btn btn-primary">
                            Add Competition Details
                        </button>
                    </a>


                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Competition Details</h3>
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
                                        <th>Action</th>
                                    </tr>

                                    @foreach($competitionDetails as $key=>$competitionDetail)
                                        <tr>
                                            <th>{{$key +1}}</th>

                                            <td>
                                                <a href="{{route('dashboard.eventPerformerEntry',$competitionDetail->id)}}">{{ $competitionDetail->name}}</a>
                                            </td>

                                            {{--<td>{{ $competitionDetail->name}}</td>--}}
                                            <td>

                                                    <?php $time = 0 ?>
                                                    <?php $remaining = 0 ?>
                                                    @foreach($competitionDetail->eventDateTimes as $date)

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


                                                    @endforeach


                                            </td>
                                            <td>{{$time}}</td>
                                            <td>{{$remaining}}</td>
                                            <td>{{ $competitionDetail->location}}</td>
                                            <td>{{ $competitionDetail->rebate_date }}</td>
                                            <td>{{ $competitionDetail->last_date_to_register}}</td>
                                            <td>

                                                <a href="{{route('competitionDetail.edit',$competitionDetail->id)}}">
                                                    <button type="button" class="btn btn-primary btn-sm">

                                                        Edit

                                                    </button>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deletecompetitionDetail-{{$competitionDetail->id}}">
                                                    Delete
                                                </button>
                                                {{--<div class="d-inline-block">--}}
                                                {{--{{ Form::open(['route' => ['competitionDetail.destroy', $competitionDetail->id], 'method' => 'DELETE']) }}--}}
                                                {{--{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}--}}
                                                {{--{{ Form::close() }}--}}
                                                {{--</div>--}}
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="deletecompetitionDetail-{{$competitionDetail->id}}"
                                             role="dialog">
                                            <div class="modal-dialog modal-sm">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Are you sure you want to delete?</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ Form::open(['route' => ['competitionDetail.destroy', $competitionDetail->id], 'method' => 'DELETE']) }}
                                                        {{ Form::submit('Yes', ['class' => 'btn btn-danger btn-sm']) }}
                                                        {{ Form::close() }}
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                                data-dismiss="modal">
                                                            NO
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </table>
                                <div class="text-center">
                                    {{--{!! $performanceCategories->links(); !!}--}}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div><!-- /.row -->
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->


    </div>
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2019</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">

    </div>
</footer>


</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="{{asset('adminLte1/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminLte1/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('adminLte1/plugins/select2/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('adminLte1/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('adminLte1/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('adminLte1/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{asset('adminLte1/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('adminLte1/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('adminLte1/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{asset('adminLte1/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('adminLte1/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminLte1/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminLte1/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminLte1/dist/js/demo.js')}}"></script>
<!-- Page script -->
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'MM/DD/YYYY h:mm A'
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false,
            template: 'modal'
        })
    })
</script>


<script id="mytemplate" type="text/x-handlebars-template">

    <div class="row" id="KEY">

        <!-- /.col (left) -->
        <div class="col-md-10">
            <div class="card card-primary">


                <!-- Date and time range -->
                <div class="form-group">
                    <label>Date and time range:</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <input type="text" class="form-control float-right" id="reservationtime">
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

            </div>
            <!-- /.card -->
        </div>

        <div class="col-sm-2">
            <button onclick="$('#KEY').remove();">Close</button>
        </div>
    </div>
</script>
<script>
    $(document).ready(function () {
        var i = 0;
        $("#add-btn").click(function (e) {
            e.preventDefault();
            i++;
            var template = $('#mytemplate').html().toString();
            $("#myform").append(template.replace(/KEY/g, i));


        });
    });
</script>
</body>
</html>

