{{--@extends('dashboardlayout.app')--}}

{{--@section('title', "Feature")--}}
{{--@section('content')--}}
    {{--<section class="content-header">--}}
        {{--<div class="container-fluid">--}}
            {{--<div class="row mb-2">--}}
                {{--<div class="col-sm-6">--}}
                    {{--<h1>Feature</h1>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div><!-- /.container-fluid -->--}}
    {{--</section>--}}
    {{--<!-- Main content -->--}}
    {{--<section class="content">--}}
        {{--<div class="container-fluid">--}}
            {{--<div class="row">--}}
                {{--<!-- left column -->--}}
                {{--<div class="col-md-12">--}}
                    {{--<!-- general form elements -->--}}
                    {{--<div class="card card-primary">--}}
                        {{--<div class="caArd-header">--}}
                            {{--<h3 class="card-title">Edit Feature</h3>--}}
                        {{--</div>--}}
                    {{--<!-- /.card-header -->--}}
                    {{--@include('partial._messages')--}}
                    {{--<!-- form start -->--}}
                        {{--{{ Form::model($feature,['url' => route( 'feature.update',$feature->id),'method'=>'PUT']) }}--}}


                        {{--{{ Form::label('title', "Name:") }}--}}
                        {{--{{ Form::text('title', null, ['class' => 'form-control']) }}--}}

                        {{--{{ Form::label('body', 'Body:') }}--}}
                        {{--{!!Form::textarea('body', null, ["class" => 'form-control',"id"=>'article-ckeditor']) !!}--}}


                        {{--{{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}--}}
                        {{--{{ Form::close() }}--}}
                        {{--form end--}}
                    {{--</div>--}}
                    {{--<!-- /.card -->--}}

                {{--</div>--}}
                {{--<!--/.col (left) -->--}}

            {{--</div>--}}
            {{--<!-- /.row -->--}}
        {{--</div><!-- /.container-fluid -->--}}
    {{--</section>--}}
    {{--<!-- /.content -->--}}
    {{--<!-- /.content-header -->--}}

{{--@endsection--}}

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
                            <h3 class="card-title">Update Studio</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <div class="card-body">
                            {{--{{dd($studio)}}--}}
                            {{ Form::model($studio,['url' => route( 'updateStudio',$studio->id),'method'=>'PUT']) }}


                            {{ Form::label('title', "Title:") }}
                            <select name="title" class="form-control" id="director_name">
                                <option value="owner">Studio Owner</option>
                                <option value="employee">Studio Employee</option>
                            </select>


                            {{ Form::label('director_name', 'Director Name:') }}
                            {{ Form::text('director_name', null, ['class' => 'form-control']) }}<br/>


                            {{ Form::label('name', 'Studio Name:') }}
                            {{ Form::text('name', $sname, null, ['class' => 'form-control']) }}<br/>

                            {{ Form::label('address', "Address:") }}
                            {{ Form::text('address', null, ['class' => 'form-control']) }}

                            {{ Form::label('city', "City:") }}
                            {{ Form::text('city', null, ['class' => 'form-control']) }}

                            {{ Form::label('state', "States:") }}
                            {{ Form::select('state', $states, null, ['class' => 'form-control']) }}

                            {{ Form::label('zip', "Zip:") }}
                            {{ Form::text('zip', null, ['class' => 'form-control']) }}

                            {{ Form::label('studio_phone', "Studio Phone:") }}
                            {{ Form::text('studio_phone', null, ['class' => 'form-control']) }}

                            {{ Form::label('cell_phone', "Cell Phone:") }}
                            {{ Form::text('cell_phone', null, ['class' => 'form-control']) }}
                            <br/>
                            <p>Please Provide all director(s), teacher(s) and choreographer(s) names to be listed in the competition program below, Names listed in this program will be listed in the same order as they are entered here. Please seperate each name with a comma.</p>
                            {{ Form::label('faculty', "Faculty:") }}
                            {{ Form::textarea('notes', null, ['class' => 'form-control']) }}


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

