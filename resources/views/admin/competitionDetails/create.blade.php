
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Competition Details</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">

                                    {!! Form::open(['route' => 'competitionDetail.store', 'method' => 'POST']) !!}

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button id="add-btn">Add Event Date</button>
                                            <div id="myform">
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            {{ Form::label('name', 'Event Name:') }}
                                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                                        </div>

                                        <div class="col-md-4">
                                            {{ Form::label('group', 'Event Group:') }}
                                            <select class="form-control" name="eGroup">
                                                <option value="Regional">Regional</option>
                                                <option value="National">National</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            {{ Form::label('location', 'Event Location  :') }}
                                            {{ Form::text('location', null, ['class' => 'form-control']) }}
                                        </div>

                                        <div class="col-md-4">
                                            {{ Form::label('rebate_date', 'Rebate Date:') }}
                                            {{ Form::date('rebate_date', null, ['class' => 'form-control']) }}
                                        </div>
                                        <div class="col-md-4">
                                            {{ Form::label('last_date_to_register', 'Last Date to Register:') }}
                                            {{ Form::date('last_date_to_register', null, ['class' => 'form-control']) }}
                                        </div>

                                        <div class="col-md-12">
                                            {{ Form::submit('Add Competition', ['class' => 'btn btn-primary btn-block btn-h1-spacing mt-3']) }}
                                        </div>

                                    </div>
                                </div>
                                {!! Form::close() !!}
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div><!-- /.row -->



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


<script id="mytemplate" type="text/x-handlebars-template">

    <div class="row" id="KEY">
        <!-- /.col (left) -->
        <div class="col-md-10">



                <!-- Date and time range -->
                <div class="form-group">
                    <label>Date and time range:</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <input type="text" name="events[KEY][date]" class="form-control float-right" id="reservationtimeKEY">
                    </div>
                    <!-- /.input group -->
                </div>

                <!-- /.form group -->
            <!-- /.card -->
        </div>

        <div class="col-sm-2">
            <button onclick="$('#KEY').remove();">Close</button>
            <input id="minuteKEY" type="text" class="form-control" name="events[KEY][time]">
            {{--<p id="minuteKEY"></p>--}}
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

            var reservation='#reservationtime' + i;
            $(reservation).daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                format: 'MM/DD/YYYY h:mm A',
                startDate: "09/05/2019 08:00 AM",
                endDate: "09/05/2019 08:00 PM"
            })

            $(reservation).change(function(e){
                // var n=e;
                // console.log(n);
                var fullDateNTime = $(reservation).val();
                var ind=fullDateNTime.indexOf("-")
                var startDT=fullDateNTime.substr(0, ind-1);
                var endDT=fullDateNTime.substr(ind+1, 21);
                var diff = Math.abs(new Date(startDT) - new Date(endDT));
                var diffmin= Math.floor((diff/1000)/60);
                var min='#minute' + i;
                $(min).val(diffmin);
                console.log(diffmin);
            });
        });
    });
</script>
</body>
</html>