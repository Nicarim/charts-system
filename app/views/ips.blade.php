@extends('master')
@section('content')
<table class="table table-bordered">
    <tr>
        <th>Address</th>
        <th>Country</th>
        <th>City</th>
        <th>Referal</th>
        <th>Referal2</th>
        <th>Assosciated</th>
        <th>Count</th>
    </tr>
    @foreach ($ips as $ip)
    <tr>
        <td>{{{$ip->address}}}</td>
        <td>{{{$ip->country_name}}}</td>
        <td>{{{$ip->city}}}</td>
        <td>{{{$ip->referal_page}}}</td>
        <td>{{{$ip->referal_page2}}}</td>
        <td>
            @if ($ip->profile == "null")
            <form action="/ip_counter_assoc/{{$ip->id}}" method="get">
                <input name="username" type="text"/>
                <button type="submit" class="btn btn-sm btn-danger">Assoc</button>
            </form>
            @else
            {{{$ip->profile}}}
            @endif
        </td>
        <td>{{{$ip->count}}}</td>
        <td><time class="timeago" datetime="{{{$ip->updated_at}}}"></time></td>
    </tr>
    @endforeach
</table>
@stop