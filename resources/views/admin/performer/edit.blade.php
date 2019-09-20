@extends('admin.dashboardlayout.app')

@section('title', "Performer")
@section('content')

    {{--{{dd($select)}}--}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Performer</h1>
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
                            <h3 class="card-title">Edit Performer</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{--<form action="{{ route('studio.performer.edit') }}" method="post"--}}
                        {{--enctype="multipart/form-data">--}}
                        {{ Form::model($performer,['url' => route( 'studio.performer.update',$performer->id),'method'=>'PUT','enctype'=>'multipart/form-data']) }}

                        {{ csrf_field() }}

                        @include('admin.partial._messages')
                        <div class="card-body">
                            <div class="form-group">

                                {{ Form::label('first_name', "Performer First Name:") }}
                                {{ Form::text('first_name', null, ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('last_name', "Performer Last Name:") }}
                                {{ Form::text('last_name', null, ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('DOB', "Date of Birth:") }}
                                {{ Form::date('DOB', null, ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('sex', "Sex:") }}

                                {{Form::select('sex',['Female' => 'Female','Male' =>'Male','Other'=>'Other'],null,
                                     ['class' => 'form-control']
                                  )}}

                            </div>

                            <div class="form-group">

                                {{--<label for="name">Performance Level</label>--}}
                                {{--<select class="form-control" name="performance_level" id="">--}}
                                    {{--@foreach($performance_levels as $performance_level)--}}
                                        {{--<option value="{{$performance_level->id}}{{ (isset($performance_level->id) || old('id'))? "selected":"" }}">{{$performance_level->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}

                                {!! Form::label('performance_level', 'Performance Level') !!}
                                {!! Form::select('performance_level', $select, null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
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
