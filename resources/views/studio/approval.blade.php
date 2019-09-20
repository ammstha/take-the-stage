@extends('admin.dashboardlayout.app')

@section('title', "Approval")
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Waiting for Approval</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{--{{dd($studio)}}--}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Your account is waiting for our administrator approval.</h3>
                          
                        </div>
                        <!-- /.card-header -->
                    @include('admin.partial._messages')
                    <!-- form start -->
                        <div class="card-body">
                         <span style="color:red;">  Please check your mail box and sign the contract to finish the registration. </span><a href="/">Home</a>
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


{{--Waiting for Approval--}}

{{--Your account is waiting for our administrator approval.--}}
{{--Please check back later.--}}