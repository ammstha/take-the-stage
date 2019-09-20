@extends('admin.dashboardlayout.app')

@section('title', "Master Constestant")
@section('content')
{{--{{dd($performers)}}--}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contestant</h1>
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
                <a href="{{route('studio.performer.create')}}">
                    <button type="button" class="btn btn-primary pull-right">Add Contestant</button>
                </a>
                {{--<a href="{{route('studio.downloadExcel')}}">--}}
                    {{--<button type="button" class="btn btn-primary pull-right">Download Excel</button>--}}
                {{--</a>--}}
                {{--<form style="border: 4px solid #a1a1a1;padding: 10px;" action="{{route('studio.importExcel')}}" class="form-horizontal" method="post" enctype="multipart/form-data">--}}
                    {{--@csrf--}}


                    {{--<input type="file" name="import_file" />--}}
                    {{--<button class="btn btn-primary">Import File</button>--}}
                {{--</form>--}}

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Master Contestant List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tr>
                                    <!--<th>Id</th>-->
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Date of Birth</th>
                                    <th>Sex</th>
                                    <th>Performance Level</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                @foreach($performers as $performer)
                                    <tr>
                                        <!--<th>{{ $performer->id }}</th>-->
                                        <td>{{ $performer->first_name }}</td>
                                        <td>{{ $performer->last_name }}</td>
                                        <td>{{ $performer->DOB }}</td>
                                        <td>{{ $performer->sex}}</td>
                                        <td>{{ $performer->performanceLevel->name}}</td>

                                        <td>

                                                <a href="{{route('studio.performer.edit',$performer->id)}}">
                                                    <button type="button" class="btn btn-primary btn-sm">Edit
                                                    </button>
                                                </a>

                                            <div class="d-inline-block">
                                               
                                                 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteperformer-{{$performer->id}}">
                                              Delete
                                            </button>
                                            </div>
                                        </td>
                                    </tr>
                                     <div class="modal fade" id="deleteperformer-{{$performer->id}}"
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
                                                        {{ Form::open(['route' => ['studio.performer.destroy', $performer->id], 'method' => 'DELETE']) }}
                                                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                                                {{ Form::close() }}
                                                          <button type="button"class="btn btn-primary btn-sm" data-dismiss="modal">
                                                        NO
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tr>


                            </table>
                            <div class="text-center">
                                {{--{!! $performers->links(); !!}--}}
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

@endsection
