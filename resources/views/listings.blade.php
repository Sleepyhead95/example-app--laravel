
{{-- This is what the code looks with .blade: --}}
@extends('layout') <!-- this is the layout file we want to extend -->

@section('content') <!-- this is the section we want to fill in - must match 
the 'content' in the layout view -->
@include ('partials._hero')
 {{-- include means you include another view but you only want it visible on this page, not the layout or any other pages --}}
@include ('partials._search')
<div
class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
>
{{-- we pass in variables by surrounding them with double curly braces --}}

{{-- <!-- directives starts with @ -->
@if(count($listings) == 0)
    <p>No listings found</p>
@endif --}}
{{-- same as if/else statement but a bit faster syntax --}}
@unless(count($listings) == 0)

@foreach ($listings as $listing)
    {{-- we pass in the component and the variable we want to pass in --}}
    <x-listing-card :listing="$listing"/>
@endforeach

@else
    <p>No listings found</p>
@endunless
</div>
<!-- we must also close the loop -->
@endsection