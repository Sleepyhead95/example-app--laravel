
{{-- This is what the code looks with .blade: --}}

<h1>{{$heading}}</h1>
{{-- we pass in variables by surrounding them with double curly braces --}}

{{-- <!-- directives starts with @ -->
@if(count($listings) == 0)
    <p>No listings found</p>
@endif --}}
{{-- same as if/else statement but a bit faster syntax --}}
@unless(count($listings) == 0)

@foreach ($listings as $listing)
    <!-- we paste the data from our route into html elements in this view: -->
    <h2>
        <a href="/listings/{{$listing['id']}}">{{$listing['title']}}</a>
    </h2>
    <p>{{$listing['description']}}</p>
@endforeach

@else
    <p>No listings found</p>
@endunless
<!-- we must also close the loop -->