@extends('admin.dashboardlayout.app')

@section('title', "Studio List")
@section('content')
{{--{{dd($studios)}}--}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Studio</h1>
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
                {{--<a href="{{route('feature.create')}}">--}}
                    {{--<button type="button" class="btn btn-primary pull-right">Add Feature</button>--}}
                {{--</a>--}}
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <span style="float: left">
                                   <h3 class="card-title">Studio Details</h3>
                            </span>
                            <span style="float: right;padding-right: 20px;">
                                <a href="{{route('downloadMusic')}}"  target="_blank">
                                <button type="button" class="btn btn-primary" >

                                        Download all music file
                                </button>
                            </a>
                            </span>
                            <span style="float: right;padding-right: 20px;">
                                <a href="{{route('studiosPDF')}}"  target="_blank">
                                <button type="button" class="btn btn-primary" >

                                        Generate all Studios Details

                                </button>
                            </a>
                            </span>


                        </div>
                        <div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Change Status</th>
                                </tr>
                                <tr>
                                    @foreach($studios as $studio)
                                    <tr>
                                        <th>{{ $studio->id }}</th>
                                        <td><a href="{{route('studio.show',$studio->id)}}">{{ $studio->name }}</a></td>
                                        <td>{{ $studio->email }}</td>
                                        <td>
                                            @if( $studio->studioX)
                                                <p>Activated</p>
                                            @else
                                                <p>Not Activated</p>
                                            @endif
                                        </td>
                                        <td>

                                                <a href="{{route('studio.edit',$studio->studio->id)}}"> <button class="btn btn-default btn-sm">Edit </button></a>



                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete-{{$studio->id}}">
                                                Delete
                                            </button>

                                            <div class="modal fade" id="delete-{{$studio->id}}"
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
                                                                    {{ Form::open(['route' => ['studio.destroy', $studio->id], 'method' => 'DELETE']) }}
                                                                    {{ Form::submit('Yes', ['class' => 'btn btn-danger btn-sm']) }}
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
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#myModal-{{$studio->id}}">Change Status
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal-{{$studio->id}}" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title">Change Status</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{--{{ Form::model($studio,['url' => route( 'admin.studio.update',$studio->slug),'method'=>'PUT']) }}--}}

                                                            <form action="{{ route('studio.update',$studio->id) }}" method="POST">
                                                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                                                <select name="status">
                                                                    <option value="1">Activate User</option>
                                                                    <option value="0">Do not Activate</option>
                                                                </select>
                                                                <button type="submit" name="SUBMIT" class="btn btn-primary">SUBMIT</button>

                                                            </form>
                                                            {{--{{Form::submit('Submit',['class'=>'btn btn-primary'])}}--}}
                                                            {{--{!! Form::close() !!}--}}

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    @endforeach
                                </tr>


                            </table>
                            <div class="text-center">
                            {!! $studios->links(); !!}
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
