@extends( 'web.master' )

@section( 'master-content' )
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-md-offset-4">
                <h2>Event Details</h2>

                @foreach($competitionDetails as $competitionDetail)
                    <p><strong>Event Name:</strong> {{$competitionDetail->name}}</p>
                    <p><strong>Event Location:</strong> {{$competitionDetail->location}}</p>
                    {{--<p><strong>Start Date:</strong> {{$competitionDetail->start_date}}</p>--}}
                    {{--<p><strong> End Date: </strong>{{$competitionDetail->end_date}}</p>--}}
                    <p><strong>Rebate Date: </strong>{{$competitionDetail->rebate_date}}</p>
                    <p><strong>Last Date to Register:</strong> {{$competitionDetail->last_date_to_register}}</p>
                    <p><strong>Event Date Time:</strong>
                        <?php $time = 0 ?>
                        <?php $remaining = 0 ?>
                        @foreach($competitionDetail->eventDateTimes as $date)

                            <?php $time += $date->time ?>
                            <?php $remaining += $date->remainingTime ?>
                            @if($loop->first)

                                <?php
                                echo substr( $date->date,0,strpos($date->date, '-'));
                                ?>

                            @endif

                            @if($loop->last)

                                <?php
                                echo substr( $date->date,strpos($date->date, '-'),22);
                                ?>

                            @endif


                        @endforeach
                    </p>
                    @if(auth()->user())
                        @role('super-admin')
                       <p>Only Studio can register the event</p>
                        @endrole

                        @role('studio')
                        <a href="{{route('studio.performerEntry.create',['id'=>$competitionDetail->id])}}">
                            <button class="btn btn-default">
                              Register Now
                            </button>
                        </a>
                        @endrole

                    @else
                        <a href="{{route('login')}}">
                            <button class="btn btn-default">
                              Register Now
                            </button>
                        </a>
                    @endif

                    <br/>
                    <hr/>
                @endforeach


            </div>
        </div>
    </div>
@stop