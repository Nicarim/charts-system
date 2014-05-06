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
        <td>{{{"none"}}}</td>
        <td>{{{$ip->count}}}</td>
    </tr>
    @endforeach
</table>
@stop