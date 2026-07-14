@props(['url'])
<tr>
<td class="header">
<a href="{{ config('app.url') }}" style="display: inline-block;">
@if (trim($slot) === config('app.name'))
<img src="{{ asset('logokc.jpg') }}" class="logo" alt="KC Logo">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>


