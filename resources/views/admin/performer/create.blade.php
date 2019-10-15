<style>
.card-primary {
    margin-top: 30px;
    
}    
    
</style>

@extends('admin.dashboardlayout.app')

@section('title', "Master Contestant List")
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Master Constestant</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                   
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Performer/Performers</h3>
                        </div>
                        {{--<a href="{{route('studio.downloadExcel')}}">--}}
                            {{--<button type="button" class="btn btn-primary pull-right">Download Excel</button>--}}
                        {{--</a>--}}
                        <form style="border: 4px solid #a1a1a1;padding: 10px;" action="{{route('studio.importExcel')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            @csrf


                            <input type="file" name="import_file" />
                            <button class="btn btn-primary">Import File</button>
                        </form>


                            @include('admin.partial._messages')
                            <div class="card-body">
                                    <p> Please enter all students' names, birthdates, performance levels and sex (for dressing room assignments). Please review performance level guidelines on our website in the Rules and Regulations to ensure that performers are placed in the proper Performance Level. The registration system will automatically calculate each entry's performance level using the information entered. To add performers, enter information and click update performers to save. To delete a performer from your list, put a check in the omit box and click the update performers to update changes. You may also upload your performer list from an Excel speadsheet
                                        <a href="{{route('studio.downloadExcel')}}">(Download Template)</a></p>
                                     

                        <form action="{{ route('studio.performer.store') }}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div id="appe">

                                </div>
<button type="submit" name="SUBMIT" class="btn btn-primary pull-right">SUBMIT</button>


                        </form>
                        
                        <button id="btn2" class="btn btn-primary" style="">Add Master Contestant</button>
                            </div>
                       
                            
                            
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

@push('stylesheets')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            var i = 0;
            $("#btn2").click(function(){
                i++;
                var template = $('#mytemplate').html().toString();
                $("#appe").append(template.replace(/KEY/g, i));
            });
        });
    </script>

    <script id="mytemplate" type="text/x-handlebars-template">
        <div class="row" id="KEY">
            <div class="col-md-2">
                <label for="name">Performer First Name</label>
                <input type="text" class="form-control" name="performers[KEY][first_name]" required>
            </div>

            <div class="col-md-2">
                <label for="name">Performer Last Name</label>
                <input type="text" class="form-control" name="performers[KEY][last_name]" required>
            </div>

            <div class="col-md-3">
                <label for="name">Date of Birth</label>
                <input type="date" class="form-control" name="performers[KEY][DOB]" required>
            </div>

            <div class="col-md-2">
                <label for="name">Sex</label>
                <select class="form-control" name="performers[KEY][sex]" id="sex">
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                    <option value="Other">Other</option>

                </select>
            </div>

            <div class="col-md-2">
                <label for="name">Performance Level</label>
                <select class="form-control" name="performers[KEY][performance_level]" id="">
                    @foreach($performance_levels as $performance_level)
                        <option value="{{$performance_level->id}}">{{$performance_level->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-1">
                <button onclick="$('#KEY').remove();">Close</button>
                {{--<p id="minuteKEY"></p>--}}
            </div>
        </div>
    </script>
@endpush
