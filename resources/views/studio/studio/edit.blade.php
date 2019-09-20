@extends('admin.dashboardlayout.app')

@section('title', "Studio")
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Studio</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{--{{dd($studio)}}--}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            @include('admin.partial._messages')
            <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Studio ({{$sname}})</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <div class="card-body">
                            {{--{{dd($studio)}}--}}
                            {{ Form::model($studio,['url' => route( 'studio.studio.update',$studio->id),'method'=>'PUT']) }}

                            <div class="row">
                                <div class="col-md-4">
                                    {{ Form::label('title', "Title:") }}
                                    <select name="title" class="form-control" id="director_name">
                                        <option value="owner">Studio Owner</option>
                                        <option value="employee">Studio Employee</option>
                                    </select>

                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('director_name', 'Director Name:') }}
                                    {{ Form::text('director_name', null, ['class' => 'form-control']) }}<br/>
                                </div>
                                <div class="col-md-4">
                                    {{--Studio Name--}}
                                    {{ Form::label('name', 'Your Name:') }}<br>
                                    <input name="name" type="text" value="{{$sname}}" id="name" class="form-control">
{{--                                    {{ Form::text('name', $sname, null, ['class' => 'form-control']) }}<br/>--}}
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('address', "Address:") }}
                                    {{ Form::text('address', null, ['class' => 'form-control']) }}
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('city', "City:") }}
                                    {{ Form::text('city', null, ['class' => 'form-control']) }}
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('state', "States:") }}
                                    {{ Form::select('state', $states, null, ['class' => 'form-control']) }}
                                </div>
                                <div class="col-md-4">

                                    {{ Form::label('zip', "Zip:") }}
                                    {{ Form::text('zip', null, ['class' => 'form-control']) }}
                                </div>
                                <div class="col-md-4">

                                    {{ Form::label('studio_phone', "Studio Phone:") }}
                                    {{ Form::text('studio_phone', null, ['class' => 'form-control']) }}
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('cell_phone', "Cell Phone:") }}
                                    {{ Form::text('cell_phone', null, ['class' => 'form-control']) }}
                                </div>
                                </div>

                            <br/>
                            <p>Please Provide all director(s), teacher(s) and choreographer(s) names to be listed in the
                                competition program below, Names listed in this program will be listed in the same order
                                as they are entered here. Please seperate each name with a comma.</p>
                            {{ Form::label('faculty', "Faculty:") }}
                            {{ Form::textarea('faculty', null, ['class' => 'form-control']) }}


                            {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
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
