@extends('admin.dashboardlayout.app')

@section('title', "Performance Category")
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Performance Category</h1>
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
                        data-target="#addPerformanceCategory">Add Performance Category
                </button>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Performance Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                @foreach($performanceCategories as $performanceCategory)
                                    <tr>
                                        <th>{{ $performanceCategory->id }}</th>
                                        <td>{{ $performanceCategory->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editPerformanceCategory-{{ $performanceCategory->id }}">Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete-{{ $performanceCategory->id }}">
                                                Delete
                                            </button>

                                            <div class="modal fade" id="delete-{{ $performanceCategory->id }}"
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
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    {{ Form::open(['route' => ['performanceCategory.destroy', $performanceCategory->id], 'method' => 'DELETE']) }}
                                                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                                                                    {{ Form::close() }}
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button type="button"class="btn btn-primary btn-sm" data-dismiss="modal">
                                                                        NO
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                             {{--<div class="d-inline-block">--}}
                                                {{--{{ Form::open(['route' => ['performanceCategory.destroy', $performanceCategory->id], 'method' => 'DELETE']) }}--}}
                                                {{--{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}--}}
                                                {{--{{ Form::close() }}--}}
                                            {{--</div>--}}
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editPerformanceCategory-{{ $performanceCategory->id }}" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Performance Categroy</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    {{--{!! Form::open(['route' => 'performanceCategory.store', 'method' => 'POST']) !!}--}}
                                                    {{ Form::model($performanceCategory, ['route' => ['performanceCategory.update', $performanceCategory->id], 'method' => "PUT",'files' => true,'enctype'=>'multipart/form-data']) }}

                                                    {{ Form::label('name', 'Name:') }}
                                                    {{ Form::text('name', null, ['class' => 'form-control']) }}

                                                    {{ Form::submit('Update Perfomrance Category', ['class' => 'btn btn-primary btn-block btn-h1-spacing mt-3']) }}

                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    </tr>


                            </table>
                            <div class="text-center">
                                {!! $performanceCategories->links(); !!}
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


    <div class="modal fade" id="addPerformanceCategory" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Performance Categroy</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'performanceCategory.store', 'method' => 'POST']) !!}
                    {{ Form::label('name', 'Name:') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}

                    {{ Form::submit('Add Performer Category', ['class' => 'btn btn-primary btn-block btn-h1-spacing mt-3']) }}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>



@endsection
