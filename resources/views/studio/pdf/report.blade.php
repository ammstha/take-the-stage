<html>
<head></head>
<body>

{{--<div>--}}
    {{--<img src="{{asset('theme/images/logo.png')}}" alt="" height="75px">--}}
{{--</div>--}}

@if($a_performerEntries )
    <table class="table table-hover" style="font-size: 10px">
        <tr>
            <th>SN</th>
            <th>Event Name</th>
            <th>Entry Division</th>
            <th>Age Class</th>
            <th>Performance Level</th>
            <th>Performer</th>
            {{--<th>Event Date</th>--}}
            <th>Title</th>
            <th>Cost</th>
            <th>Early Bid Discount</th>
            <th>Regualar Price</th>
            <th>Total Cost</th>
        </tr>

        {{--<tr>--}}
            {{----}}
        {{--</tr>--}}
        @foreach($a_performerEntries as $key=>$pEntry)
            <tr>
                <th>{{ $key +1}}</th>
                <td>{{ $pEntry['event_name']}}</td>
                <td>{{ $pEntry['p']->division}}</td>
                <td>{{ $pEntry['p']->age_class}}</td>
                <td>{{ $pEntry['p']->performance_level}}</td>

                <td>

                @foreach(  $pEntry['p']->performers()->get() as $performer)
                    <span>{{$performer->first_name}}</span><br>

                @endforeach
                </td>
                {{--<td>--}}
                {{--@foreach($pEntry['performerEntry']->eventDateTimes()->get() as $date )--}}
                    {{--@if ($loop->first)--}}
                        {{--{{$date->date}}--}}
                    {{--@endif--}}

                    {{--@if ($loop->last)--}}

                    {{--@endif--}}

                {{--@endforeach--}}
                {{--</td>--}}
                {{--{{dd($pEntry['performerEntry'])}}</td>--}}
                <td>{{ $pEntry['title']}}</td>
                <td>$ {{ $pEntry['cost']}}</td>
                <td>$ {{ $pEntry['discount']}}</td>
                <td>$ {{ $pEntry['charge']}}</td>
                <td>$ {{ $pEntry['totalCost']}}</td>
                {{--->competitionDetail->name}}--}}
            </tr>
        @endforeach


    </table>
    Total Cost: ${{$total_Cost_Sum}}
@else
    NO DATA
@endif
</body>
</html>
