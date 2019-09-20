@extends('admin.dashboardlayout.app')

@section('title', "Result")
@section('content')
    {{--{{dd($results)}}--}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Result</h1>
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
                        data-target="#addResult">Add Result
                </button>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Result</h3>
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
                                @foreach($results as $result)
                                    <tr>
                                        <th>{{ $result->id }}</th>
                                        <td>
                                            @if($image = $result->image()->where('meta','Result_Image')->first())
                                                <img src="{{asset($image->url) }}" class="" height="auto" width="50px">
                                            @endif
                                        </td>
                                        <td>{{ $result->title }}</td>
                                        <td>{{ $result->description }}</td>

                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editResult-{{$result->id}}">Edit
                                            </button>
                                            <div class="d-inline-block">
                                                {{ Form::open(['route' => ['result.destroy', $result->id], 'method' => 'DELETE']) }}
                                                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                                                {{ Form::close() }}
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editResult-{{$result->id}}" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Result</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">

                                                    {{ Form::model($result, ['route' => ['result.update', $result->id], 'method' => "PUT",'files' => true,'enctype'=>'multipart/form-data']) }}


                                                    {{--{!! Form::open(['route' => 'Result.store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}--}}
                                                    {{ Form::label('title', 'Title:') }}
                                                    {{ Form::text('title', null, ['class' => 'form-control']) }}

                                                    {{ Form::label('description', 'Description:') }}
                                                    {{ Form::textarea('description', null, ['class' => 'form-control']) }}

                                                    {{ Form::label('result_image', 'Result Image:') }}
                                                    {{ Form::file('result_image', null, ['class' => 'form-control']) }}

                                                    {{ Form::submit('Add Result', ['class' => 'btn btn-primary btn-block btn-h1-spacing mt-3']) }}

                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    </tr>


                            </table>
                            <div class="text-center">
                                {{--{!! $results->links(); !!}--}}
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

    <div class="modal fade" id="addResult" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Result Image</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">


                    {!! Form::open(['url' => route( 'result.store'),'method'=>'POST','files' => true,'enctype'=>'multipart/form-data']) !!}

                    {{--{!! Form::open(['route' => 'Result.store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}--}}
                    {{ Form::label('title', 'Title:') }}
                    {{ Form::text('title', null, ['class' => 'form-control']) }}

                    {{ Form::label('description', 'Description:') }}
                    {{ Form::textarea('description', null, ['class' => 'form-control']) }}

                    {{ Form::label('result_image', 'Result Image:') }}
                    {{ Form::file('result_image', null, ['class' => 'form-control']) }}

                    {{ Form::submit('Add Result', ['class' => 'btn btn-primary btn-block btn-h1-spacing mt-3']) }}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>



@endsection
