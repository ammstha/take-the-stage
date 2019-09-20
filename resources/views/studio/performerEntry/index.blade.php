@extends('admin.dashboardlayout.app')

@section('title', "Entry List")
@section('content')
    {{--{{dd( $a_performerEntries)}}--}}
    {{--{{dd( $total_Cost_Sum)}}--}}

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Entry List</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('admin.partial._messages')
    <!-- Main content -->

    @if ($message = Session::get('success'))
        <div class="w3-panel w3-green w3-display-container">
            {{--<span onclick="this.parentElement.style.display='none'"--}}
            {{--class="w3-button w3-green w3-large w3-display-topright">&times;</span>--}}
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('success');?>
    @endif

    @if ($message = Session::get('error'))
        <div class="w3-panel w3-red w3-display-container">
            {{--<span onclick="this.parentElement.style.display='none'"--}}
            {{--class="w3-button w3-red w3-large w3-display-topright">&times;</span>--}}
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('error');?>
    @endif



    <section class="content">
        <div class="container-fluid">


            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Performer list of the Studio</h3>
                            <a href="{{route('studio.checkout')}}">
                                <button type="button"  class="btn btn-primary pull-right"   onclick="calculatePrice()">Proceed to CheckOut
                            </button>
                            </a>
                            {{--<button type="button" class="btn btn-primary pull-right" data-toggle="modal"--}}
                                    {{--onclick="calculatePrice()"--}}
                                    {{--data-target="#addcompetitionDetail">Calculate Cost--}}
                            {{--</button>--}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tr>
                                    <th>SN</th>
                                    <th>Title</th>
                                    <th>Audio</th>
                                    <th>Division</th>
                                    <th>Average Age</th>
                                    <th>Age Class</th>
                                    <th>Performance Level</th>
                                    <th>Event Name</th>
                                    <th>Stauts</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                @foreach($allPerformerEntries as $key=>$performerEntry)
                                    {{--{{dd($performerEntry->competitionDetail)}}--}}
                                    <tr>
                                        <th>{{ $key +1}}</th>
                                        <td>{{ $performerEntry->title}}</td>
                                        <td>
                                            @if($file = $performerEntry->file()->where('meta','Music')->first())
                                                <audio controls>
                                                    <source src="{{asset($file->url)}}" type="audio/mpeg">
                                                </audio>
                                                {{--<img src="{{asset($image->url) }}" class="" height="auto" width="50px">--}}
                                            @endif
                                        </td>
                                        <td>{{ $performerEntry->division}}</td>
                                        <td>{{ $performerEntry->average_age }}</td>
                                        <td>{{ $performerEntry->age_class}}</td>
                                        <td>{{ $performerEntry->performance_level}}</td>
                                        <td>
                                            {{ $performerEntry->competitionDetail->name}}<br>
                                            {{ $performerEntry->competitionDetail->eGroup}}
                                            {{--{{ $performerEntry->eventDateTime->date}}--}}
                                        </td>
                                        <td>
                                            @if($performerEntry->status)
                                                <b>PAID</b>
                                            @else
                                                <b>UNPAID</b>
                                            @endif
                                        </td>
                                        <td>

                                            <a href="{{route('studio.performerEntry.edit',$performerEntry->id)}}">
                                                <button type="button" class="btn btn-primary btn-sm">Edit
                                                </button>
                                            </a>

                                            <a href="{{route('studio.performerEntry.duplicate',$performerEntry->id)}}">
                                                <button type="button" class="btn btn-default btn-sm">Duplicate
                                                </button>
                                            </a>

                                            <div class="d-inline-block">
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteperformerEntry-{{$performerEntry->id}}">
                                                    Delete
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteperformerEntry-{{$performerEntry->id}}"
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
                                                    {{ Form::open(['route' => ['studio.performerEntry.destroy', $performerEntry->id], 'method' => 'DELETE']) }}
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


                            </table>
                            <div class="text-center">
                                {{--{!! $performanceCategories->links(); !!}--}}
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


    <div class="modal fade" id="addcompetitionDetail" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Calculate</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @if($a_performerEntries )
                        <table class="table table-hover">
                            <tr>
                                <th>SN</th>
                                <th>Title</th>
                                <th>Cost</th>
                                <th>Early Bid Discount</th>
                                <th>Regualar Price</th>
                                <th>Total Cost</th>
                            </tr>
                            @foreach($a_performerEntries as $key=>$pEntry)
                                <tr>
                                    <th>{{ $key +1}}</th>
                                    <td>{{ $pEntry['title']}}</td>
                                    <td>$ {{ $pEntry['cost']}}</td>
                                    <td>$ {{ $pEntry['discount']}}</td>
                                    <td>$ {{ $pEntry['charge']}}</td>
                                    <td>$ {{ $pEntry['totalCost']}}</td>
                                </tr>

                            @endforeach


                        </table>
                        Total Cost: ${{$total_Cost_Sum}}
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal"

                                data-target="#checkout">Check Out
                        </button>

                    @else
                        NO DATA
                        @endif

                </div>

            </div>
        </div>
    </div>
    {{--Term and condition model--}}
    <div class="modal fade" id="checkout" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Terms and Condition</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>
                        Submitted entry fees are due immediately and are non-refundable. Once
                        entries are submitted, a refund will not be issued for entry fees. Please
                        ensure that all entries are correct prior to submitting, as totals due and
                        charged will be based on the submission. By clicking below, you agree that
                        all entry fees calculated are due to Take The Stage Dance, L.L.C.
                        immediately and are non-refundable.
                        By submitting entries via online registration, I agree to hold harmless and
                        indemnify Take The Stage Dance L.L.C. its agents, directors, employees and
                        independent contractors from any and all claims, suits, liabilities, court
                        costs and legal fees resulting from any injury, damage and/or illness that
                        may occur while participating in any activities related to the competition.
                        I attest that I am an authorized agent or representative of the contestants
                        participating in said competition and hereby authorize the use of their
                        images and names for marketing and advertising purposes. I further agree
                        that I have read, understand and agree to comply with the Take The Stage
                        Dance L.L.C. rules and regulations.
                    </p>
                    <b>Videography and Photography Policy</b>
                    <p>
                        Video recording is strictly prohibited at Take the Stage dance competition events. Take
                        the Stage employs professional videographers to capture and sell video recordings of
                        performances which may be purchased by the performers or members of their studios.
                        When no professional videographer is available, Take the Stage may permit each
                        attending dance school to designate a videographer to record performances of students
                        from that school.
                        For the safety of performers and to prevent distractions, Take the Stage only permits still
                        photography during award presentations. Still photography by audience members is
                        otherwise strictly prohibited. Take the Stage employs professional photographers to
                        capture and sell photographs of dance performances. Cameras of any kind are prohibited
                        in the dressing rooms.
                        Failure to comply with these rules could result in removal from the premises and the
                        disqualification of dancer(s) and/or studio(s). We urge all studio owners, teachers, parents
                        and audience members to comply with these rules to make the event as enjoyable as
                        possible for everyone</p>
                    <b>Warning for those with seizure disorders, breathing disorders, or heart
                        issues</b>
                    <p>Please be advised that it is common for Take the Stage to use strobe light effects, laser
                        effects, and water/glycerin based haze fluid throughout the competition.<br>
                        Your cooperation is greatly appreciated.</p>
                    <b>CERTIFICATIONAND INDEMNIFICATION</b>


                    <form method="POST" id="payment-form" action="{{ route('studio.paypal') }}"
                          onsubmit="return validateForm()">
                        {{ csrf_field() }}
                        <input id="amount" type="hidden" name="amount"></p>
                        <div class="checkbox">
                            <label><input type="checkbox" value="1" onclick="terms();" id="termNCondition">I accept the
                                terms and condition</label>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right" id="checkoutbtn" disabled>CheckOut
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{--Term and condition model -- end--}}
@endsection
@push('scripts')

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script>

        function calculatePrice() {

            //count the total no of performer Entries
            let performerEntriesCount = "{{$performerEntries->count()}}";
            // true if the total performer in the performer entry is >= 10
            let perfromerCount = "{{$countPerformerEntry}}";
            if (!(performerEntriesCount >= 5 || perfromerCount)) {
                alert('A minimum of 5 entries or 10 participating dancers per studio is required to compete.');
                return false;
            }


            let duoTrioPerformer = "{{$duoTrioPerformer}}";
            let soloPerformer = "{{$soloPerformer}}";
            if (duoTrioPerformer >= 5 || soloPerformer >= 5) {
                alert('A maximum of 5 Solo and 5 Duo Trio entries per studio is allowed');
                return false;
            }

            document.getElementById("amount").value = "{{$total_Cost_Sum}}";


        }

        function validateForm() {


            //count the total no of performer Entries
            let performerEntriesCount = "{{$performerEntries->count()}}";
            // true if the total performer in the performer entry is >= 10
            let perfromerCount = "{{$countPerformerEntry}}";
            if (!(performerEntriesCount >= 5 || perfromerCount)) {
                alert('A minimum of 5 entries or 10 participating dancers per studio is required to compete.');
                return false;
            }


            let duoTrioPerformer = "{{$duoTrioPerformer}}";
            let soloPerformer = "{{$soloPerformer}}";
            if (duoTrioPerformer >= 5 || soloPerformer >= 5) {
                alert('A maximum of 5 Solo and 5 Duo Trio entries per studio is allowed');
                return false;
            }
        }

        function terms() {
            // Get the checkbox
            var checkB = document.getElementById("termNCondition").checked;

            // If the checkbox is checked, display the output text
            if (checkB == true) {
                document.getElementById("checkoutbtn").disabled = false;
            } else {
                document.getElementById("checkoutbtn").disabled = true;

            }
        }
    </script>
@endpush