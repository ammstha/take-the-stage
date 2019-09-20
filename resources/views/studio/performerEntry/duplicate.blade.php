@extends('admin.dashboardlayout.app')

@section('title', "Duplicate Master Contestent")
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Duplicate Entry Form</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                {{--{{dd($music)}}--}}
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> Duplicate Entry Form</h3>
                        </div>
                        <!-- /.card-header -->

                        {{--{{dd($music->id)}}--}}
                        <!-- form start -->
                        {{ Form::model($performerEntry,['url' => route( 'studio.performerEntry.duplicateCreate'),'method'=>'POST','enctype'=>'multipart/form-data']) }}
                        {{ csrf_field() }}

                        @include('admin.partial._messages')
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="name">Event</label>
                                    <select class="form-control" name="competitionDetail_id">
                                        <option>Please Select a Event</option>



                                        <optgroup label="Regional">
                                            @foreach( $competitionDetails->where('eGroup','Regional') as $competitionDetail)
                                                <option value="{{$competitionDetail->id}}">{{$competitionDetail->name}}( <b>
                                                        @foreach($competitionDetail->eventDateTimes()->get() as $date )
                                                            @if ($loop->first)
                                                                {{$date->date}}
                                                            @endif

                                                            @if ($loop->last)
                                                            @endif
                                                        @endforeach
                                                    </b> )</option>
                                            @endforeach
                                        </optgroup>

                                        <optgroup label="National">
                                            @foreach( $competitionDetails->where('eGroup','National') as $competitionDetail)
                                                <option value="{{$competitionDetail->id}}">{{$competitionDetail->name}}( <b>
                                                        @foreach($competitionDetail->eventDateTimes()->get() as $date )
                                                            @if ($loop->first)
                                                                {{$date->date}}
                                                            @endif

                                                            @if ($loop->last)

                                                            @endif

                                                        @endforeach
                                                    </b> )</option>
                                            @endforeach
                                        </optgroup>
                                    </select>

                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--{{ Form::label('title', 'Entry Title/Name of Music') }}--}}
                                {{--{{ Form::text('title', null, ["class" => 'form-control']) }}--}}
                            {{--</div>--}}

                                <input type="hidden" name="title" value="{{$performerEntry->title}}">
                                <input type="hidden" name="music" value="{{$music->id}}">
                                {{--<input type="hidden" name="performers" value="{{$performerEntry->id}}">--}}

                            <div class="form-group" onchange="calcu()">
                                <label for="age">Performer</label><br>
                                <div class="performer">
                                    <div class="row">
                                        @foreach($perfs as $perf)
                                            <div class="col-md-2">
                                                <label>
                                                    {{ Form::checkbox('performers[]', $perf['id'], null, ['class' => 'performerCheckbox','data-age'=>"{$perf['age']}",'data-plevel'=>"{$perf['p-level']}"]) }}
                                                    {{$perf['first_name']}} {{$perf['last_name']}} ({{$perf['id']}})
                                                </label>
                                            </div>

                                        @endforeach
                                    </div>

                                </div>
                            </div>

                            <input type="hidden" name="performance_level" value="{{$performerEntry->performance_level}}">
                            <input type="hidden" name="division" value="{{$performerEntry->division}}">
                            <input type="hidden" name="average_age" value="{{$performerEntry->average_age}}">
                            <input type="hidden" name="age_class" value="{{$performerEntry->age_class}}">
                            <input type="hidden" name="exceed" value="{{$performerEntry->exceed}}">
                            <input type="hidden" name="donate" value="{{$performerEntry->donate}}">
                            <input type="hidden" name="prop" value="{{$performerEntry->prop}}">
                        </div>

                        {{Form::submit('Duplicate Entry',['class'=>'btn btn-primary'])}}
                        {!! Form::close() !!}
                        {{--<button type="submit" name="SUBMIT" class="btn btn-primary pull-right">Add Entry</button>--}}
                        {{--</form>--}}
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

@push('scripts')
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>--}}
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script>


        function calcu() {
            // Average age
            function calculateAge() {
                var favorite = [];
                $.each($('.performer :checked'), function () {
                    favorite.push($(this).attr('data-age'));
                });
                return Math.round(eval(favorite.join('+')) / favorite.length);
            }

            var averageAge = calculateAge()

            //Find the maximum age
            function arrayOfAgeClass() {
                var favorite = [];
                $.each($('.performer :checked'), function () {
                    favorite.push($(this).attr('data-age'));
                });
                return favorite;
            }

            var arrayofAge = arrayOfAgeClass();
            var maximum = Math.max.apply(null, arrayofAge);

            //Find age class ie: Pettie, Junior
            function ageClass(avgAge) {
                if (avgAge >= 5 & avgAge <= 8) {
                    return "Petite";
                } else if (avgAge >= 9 & avgAge <= 12) {
                    return "Junior";
                } else if (avgAge >= 13 & avgAge <= 15) {
                    return "Teen";
                } else if (avgAge >= 16 & avgAge <= 24) {
                    return "Senior";
                } else if (avgAge >= 25) {
                    return "Adult";
                } else {
                    return "Select the performer or not eligible"
                }
            }

            var ageclass = ageClass(averageAge);
            var maxclass = ageClass(maximum);

            //Find Class Ceiling ie:8,12,15,24
            function findCLassCeiling(agClass) {
                var ceiling = 0;
                switch (agClass) {
                    case "Petite":
                        ceiling = 8;
                        break;
                    case "Junior":
                        ceiling = 12;
                        break;
                    case "Teen":
                        ceiling = 15;
                        break;
                    case "Senior":
                        ceiling = 24;
                        break;
                    default:
                        ceiling = 100;
                        break;
                }
                return ceiling;
            }

            var avgclassCeiling = findCLassCeiling(ageclass);
            var maxclassCeiling = findCLassCeiling(maxclass);

            function calculateBumpedClass() {
                var bumpedClass;
                if (maximum > avgclassCeiling) {
                    switch (maxclassCeiling) {
                        case "Adult":
                            switch (ageclass) {
                                case "Teen":
                                    bumpedClass = "Senior";
                                    break;
                                case "Junior":
                                    bumpedClass = "Senior";
                                    break;
                                case "Petite":
                                    bumpedClass = "Senior";
                                    break;
                                default:
                                    bumpedClass = ageclass;
                                    break;
                            }
                            break;
                        case "Senior":
                            if (ageclass == "Junior") {
                                bumpedClass = "Teen";
                            } else if (ageclass == "Petite") {
                                bumpedClass = "Teen";
                            } else {
                                bumpedClass = ageclass;
                            }
                            break;
                        case "Teen":
                            if (ageclass == "Petite") {
                                bumpedClass = "Junior";
                            } else {
                                bumpedClass = ageclass;
                            }
                            break;
                        default:
                            bumpedClass = ageclass;
                            break;
                    }
                } else {
                    bumpedClass = ageclass;
                }
                return bumpedClass;
            }

            var bumped = calculateBumpedClass();

            // alert(bumped);

            function getDivision() {
                var countPerformer = $('.performer :checked').size();

                if (countPerformer == 1) {
                    return "Solo";
                } else if (countPerformer >= 2 && countPerformer <= 3) {
                    return "Duo/Trio";
                } else if (countPerformer >= 4 && countPerformer <= 9) {
                    return "Small Group";
                } else if (countPerformer >= 10 && countPerformer <= 14) {
                    return "Large Group";
                } else if (countPerformer == 0) {
                    return "Select Perfomer";
                } else {
                    return "Line";
                }
            }

            var division = getDivision();

            //Store checked Performance level ie: Aamature, Elite, Pro and Competitive in array
            function perfomrancelevel() {

                var plevel = [];
                $.each($('.performer :checked'), function () {
                    plevel.push($(this).attr('data-plevel'));
                });
                return plevel;
                // var countAmature=4;
                // var countCompetitive=;
                // var countElite=;
                // var countProAm

            }

            //Array of Perfromance Level
            var arrayofPlevel = perfomrancelevel();

            //count Amateur
            var A = function Aa() {
                var countA = 0;
                for (var i = 0; i < arrayofPlevel.length; ++i) {
                    if (arrayofPlevel[i] === "Amateur")
                        countA++;
                }
                return countA;
            }
            //count Competitive
            var C = function Cc() {
                var countB = 0;
                for (var i = 0; i < arrayofPlevel.length; ++i) {
                    if (arrayofPlevel[i] === "Competitive")
                        countB++;
                }
                return countB;
            }
            //count elite
            var E = function Ee() {
                var countE = 0;
                for (var i = 0; i < arrayofPlevel.length; ++i) {
                    if (arrayofPlevel[i] === "Elite")
                        countE++;
                }
                return countE;
            }
            //count pro Am
            var P = function Pp() {
                var countP = 0;
                for (var i = 0; i < arrayofPlevel.length; ++i) {
                    if (arrayofPlevel[i] === "ProAm")
                        countP++;
                }
                return countP;
            }

            console.log("Amature :" + A());
            console.log("Competitive:" + C());
            console.log("Elite :" + E());
            console.log("Pro:" + P());

            function performanceL() {
                if (A() == C()) {
                    return "Competitive";
                } else if (A() > C() || A() > E() || A() > P()) {
                    return "Amateur";
                } else if (C() > A() || C() > P() || C() > E()) {
                    return "Competitive";
                } else if (E() > A() || E() > C() || E() > P() || C() == E() || A() == E()) {
                    return "Elite";
                } else {
                    return "Pro Am";
                }
            }


            document.getElementById("ageClass").value = bumped;
            document.getElementById("averageAge").value = averageAge;
            document.getElementById("division").value = division;
            document.getElementById("PL").value = performanceL();


            var DEEcheckbox = function () {
                if (division == "Solo" || division == "Duo/Trio") {
                    return true;
                } else {
                    return false;
                }
            }

            // alert(DEEcheckbox());

            document.getElementById("exceedCheckbox").disabled = DEEcheckbox();
        }


    </script>
@endpush