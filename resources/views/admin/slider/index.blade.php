@extends('admin.dashboardlayout.app')

@section('title', "Slider")
@section('content')
    {{--{{dd($performers)}}--}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Slider</h1>
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
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                        data-target="#addSlider">Add Slider Image
                </button>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Slider</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                @foreach($sliders as $slider)
                                    <tr>
                                        <th>{{ $slider->id }}</th>
                                        <td>
                                            @if($image = $slider->image()->where('meta','Slider_Image')->first())
                                                <img src="{{asset($image->url) }}" class="" height="auto" width="50px">
                                            @endif
                                        </td>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->description}}</td>

                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editSlider-{{$slider->id}}">Edit
                                            </button>
                                             <div class="d-inline-block">
                                                {{ Form::open(['route' => ['slider.destroy', $slider->id], 'method' => 'DELETE']) }}
                                                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                                                {{ Form::close() }}
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editSlider-{{$slider->id}}" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Slider Image</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">

                                                    {{ Form::model($slider, ['route' => ['slider.update', $slider->id], 'method' => "PUT",'files' => true,'enctype'=>'multipart/form-data']) }}

                                                    {{--{!! Form::open(['url' => route( 'slider.store'),'method'=>'POST','files' => true,'enctype'=>'multipart/form-data']) !!}--}}

                                                    {{--{!! Form::open(['route' => 'slider.store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}--}}
                                                    {{ Form::label('title', 'Title:') }}
                                                    {{ Form::text('title', null, ['class' => 'form-control']) }}

                                                    {{ Form::label('description', 'Description:') }}
                                                    {{ Form::textarea('description', null, ['class' => 'form-control']) }}

                                                    {{ Form::label('slider_image', 'Slider Image:') }}
                                                    {{ Form::file('slider_image', null, ['class' => 'form-control']) }}

                                                    {{ Form::submit('Add Slider', ['class' => 'btn btn-primary btn-block btn-h1-spacing mt-3']) }}

                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    </tr>


                            </table>
                            <div class="text-center">
                                {{--{!! $sliders->links(); !!}--}}
                            </div>
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

    <div class="modal fade" id="addSlider" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Slider Image</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">


                    {!! Form::open(['url' => route( 'slider.store'),'method'=>'POST','files' => true,'enctype'=>'multipart/form-data']) !!}

                    {{--{!! Form::open(['route' => 'slider.store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}--}}
                    {{ Form::label('title', 'Title:') }}
                    {{ Form::text('title', null, ['class' => 'form-control']) }}

                    {{ Form::label('description', 'Description:') }}
                    {{ Form::textarea('description', null, ['class' => 'form-control']) }}

                    {{ Form::label('slider_image', 'Slider Image:') }}
                    {{ Form::file('slider_image', null, ['class' => 'form-control']) }}

                    {{ Form::submit('Add Slider', ['class' => 'btn btn-primary btn-block btn-h1-spacing mt-3']) }}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
