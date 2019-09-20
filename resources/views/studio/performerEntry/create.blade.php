@extends('admin.dashboardlayout.app')

@section('title', "Master Contestent")
@section('content')



    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Entry Form</h1>
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
                            <h3 class="card-title">Entry Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('studio.performerEntry.store') }}" method="post"
                              enctype="multipart/form-data" name="first">
                            {{ csrf_field() }}

                            @include('admin.partial._messages')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Event</label>
                                    @if(is_null($competitionDetail))
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
                                    @else
                                        <select class="form-control" name="competitionDetail_id" readonly>
                                            <optgroup label="">

                                                    <option value="{{$competitionDetail->id}}" selected>{{$competitionDetail->name}}( <b>
                                                            @foreach($competitionDetail->eventDateTimes()->get() as $date )
                                                                @if ($loop->first)
                                                                    {{$date->date}}
                                                                @endif

                                                                @if ($loop->last)

                                                                @endif

                                                            @endforeach
                                                        </b> )</option>

                                            </optgroup>


                                        </select>
                                    @endif



                                </div>
                                <div class="form-group">
                                    <label for="name">Entry Title/Name of Music</label>
                                    <input type="text" class="form-control" name="title">
                                </div>

                                <div class="form-group">
                                    <label for="music">Upload Music</label>
                                    <input type="file" class="form-control" name="music">
                                </div>

                                <div class="form-group" onchange="calcu()">
                                    <label for="age">Performer</label><br>
                                    <div class="performer">
                                        <div class="row">
                                            @foreach($performers as $performer)
                                                <div class="col-md-2">
                                                    <label>
                                                        <input type="checkbox" class="performerCheckbox" name="performers[]"
                                                               data-age="{{$performer->age}}"
                                                               data-plevel="{{$performer->performanceLevel->name}}"
                                                               value="{{$performer->id}}">
                                                        {{$performer->first_name}} {{$performer->last_name}}
                                                        ({{$performer->age}})
                                                    </label>
                                                </div>

                                            @endforeach
                                        </div>

                                    </div>
                                </div>

                                {{--<input type="text" id="averageAge" size="50">--}}

                                <!--<div class="form-group">-->
                                <!--    <label for="a">Performance Category</label><br>-->
                                <!--    @foreach($performanceCategories as $performanceCategory)-->
                                <!--        <label style="margin-right:30px">-->
                                <!--            <input type="checkbox" name="performanceCategories[]"-->
                                <!--                   value="{{$performanceCategory->id}}">-->
                                <!--            {{$performanceCategory->name}}-->
                                <!--        </label>-->
                                <!--    @endforeach-->
                                <!--</div>-->

                                <div class="form-group">
                                  <label for="sel1">Performance Categories</label>
                                         <select name=performanceCategories class="form-control" id="">
                                             <option>--Please Select Category--</option>
                                              @foreach($performanceCategories as $performanceCategory)
                                    <option  value="{{$performanceCategory->id}}">{{$performanceCategory->name}}</option>
                                     @endforeach
                                  </select>


                                </div>

                                <div class="form-group">
                                    <label for="name">Performance Level</label>
                                    {{--<p class="form-control" id="PL"></p>--}}
                                    <input type="text" class="form-control" id="PL" name="performance_level"  readonly>
                                </div>

                                <div class="form-group">
                                    <label for="age">Entry Division</label>
                                    {{--<p class="form-control" id="division"></p>--}}
                                    <input type="text" class="form-control" id="division" name="division" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="age"> Average Age:</label>
                                    {{--<p class="form-control" id="division"></p>--}}
                                    <input type="text" class="form-control" id="averageAge" name="average_age" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="age"> Age Class:</label>
                                    {{--<p class="form-control" id="division"></p>--}}
                                    <input type="text" class="form-control" id="ageClass" name="age_class" readonly>
                                </div>


                                <div class="form-group">
                                    <label><input type="checkbox" value="1" name="exceed" id="exceedCheckbox" disabled>
                                        Please check here if an extended time of 2 minute is required for any entry that
                                        exceeds the standard time limit.Solo, Duos/Trios are not eligible for
                                        this option. Group and line production only.There is an additional charge of $3
                                        per dancer.
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label><input type="checkbox" value="1" name="donate">
                                        Please check here if your studio would like to donate the cost of adjucationa
                                        award(for group only) to charity of your choice. Studios will receive a letter
                                        of recognnigation.
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label><input type="checkbox" value="1" name="prop">
                                        Please check here if your studio would like to use a prop for this entry. A time
                                        limit of 2 minutes total will be allowed for both the set-up and a strike of
                                        props and is the sole responsibility of the studio.
                                    </label>
                                </div>


                            </div>
                            <button type="submit" name="SUBMIT" class="btn btn-primary pull-right">Add Entry</button>


                        </form>
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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script>


        function calcu() {
            // Average age
            function calculateAge() {
                var favorite = [];
                $.each($('.performer :checked'), function () {
                    favorite.push($(this).attr('data-age'));
                });
                // Math.floor(x) returns the value of x rounded  to its nearest integer:
                return Math.floor(eval(favorite.join('+')) / favorite.length);
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


            //Find average ageClass ie:Teen Adult
            var avgclass = ageClass(averageAge);

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
            //ie:8,12 ...
            var avgclassCeiling = findCLassCeiling(avgclass);
            var maxclassCeiling = findCLassCeiling(maxclass);

            function calculateBumpedClass() {
                console.log("Average class celling:"+avgclassCeiling);
                console.log("Max class celling:"+maxclassCeiling);
                console.log("Max class:"+maxclass);
                console.log("Maximum:"+maximum);
                console.log("Average:"+ avgclass);
                console.log("Array of age:"+ arrayofAge);
                var bumpedClass;
                if (maximum > avgclassCeiling) {
                    switch (maxclass) {
                        case "Adult":
                            switch (avgclass) {
                                case "Junior":
                                    bumpedClass = "Adult";
                                    break;
                                case "Petite":
                                    bumpedClass = "Adult";
                                    break;
                                case "Teen":
                                    bumpedClass = "Adult";
                                    break;
                                case "Senior":
                                    bumpedClass = "Adult";
                                    break;
                                default:
                                    console.log('hey i am here');
                                    bumpedClass = avgclass;
                                    break;
                            }
                            break;
                        case "Senior":
                            switch (avgclass) {
                                case "Adult":
                                    bumpedClass = "Adult";
                                    break;
                                case "Teen":
                                    bumpedClass = "Teen";
                                    break;
                                case "Junior":
                                    bumpedClass = "Teen";
                                    break;
                                case "Petite":
                                    console.log('hey i ahaha m here');
                                    bumpedClass = "Teen";
                                    break;
                                default:
                                    console.log('hey i am here');
                                    bumpedClass = avgclass;
                                    break;
                            }
                            break;

                        case "Teen":
                            switch (avgclass) {
                                case "Adult":
                                    bumpedClass = "Adult";
                                    break;
                                case "Teen":
                                    bumpedClass = "Teen";
                                    break;
                                case "Junior":
                                    bumpedClass = "Junior";
                                    break;
                                case "Petite":
                                    bumpedClass = "Junior";
                                    break;
                                default:
                                    bumpedClass = avgclass;
                                    break;
                            }
                            break;

                        case "Junior":
                            //
                            // If 1 Jr. & Average Age is Petite then Petite
                            // If 1 Jr. & Average Age is Jr. then Jr.
                            // If 1 Jr. & Average Age is Teen then Teen
                            // If 1 Jr. & Average Age is Sr. then Senior
                            // If 1 Jr. & Average Age is Adult then Adult
                            switch (avgclass) {
                                case "Adult":
                                    bumpedClass = "Adult";
                                    break;
                                case "Teen":
                                    bumpedClass = "Teen";
                                    break;
                                case "Senior":
                                    bumpedClass = "Senior";
                                    break;
                                case "Petite":
                                    bumpedClass = "Petite";
                                    break;
                                default:
                                    bumpedClass = avgclass;
                                    break;
                            }
                            break;

                        default:
                            console.log('hey now i am here');
                            bumpedClass = avgclass;
                            break;
                    }
                } else {
                    bumpedClass = avgclass;
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
                    if (arrayofPlevel[i] === "Pro-Am")
                        countP++;
                }
                return countP;
            }

            // console.log("Amature :"+A());
            // console.log("Competitive:"+C());
            // console.log("Elite :"+E());
            // console.log("Pro:"+P());
            function performanceL(){
                if (P() >= 1){
                    console.log("p");
                    return "Pro Am";
                }
                else if (A() === C() && (A() + C()) != 0 ){
                    console.log("C");
                   return "Competetive";
                }

                else if (  (A() > C() && A() > E() && A() > P()) &&  (A() != E() || (A() + E())!=0  ) ){
                    console.log("a");
                   return "Amateur";
                }

                else if (  (C() > A() && C() >E()) && (C()!=E())){
                    console.log("Ca");
                   return "Competetive";
                }

                else if (E() > A() && (  C() === E() && (C() + E())!=0  ) &&(A() === E() && (A() + E())!=0)  && E() > C() ){
                    console.log("e");
                   return "Elite";
                }
                else if (E() > (C() &&  P() &&  A()) ){
                    console.log("e");
                   return "Elite";
                }

                else{
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