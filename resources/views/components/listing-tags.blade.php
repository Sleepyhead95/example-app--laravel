@props(['tagsCsv'])
{{-- Csv = comma separated values  --}}

@php 
// we use the PHP tag to run php logic/functions directly in the blade view
// because blade can only handle a limited amount of php function (like displaying)
// but not more complex logic like transforming arrays, in this case

    $tags = explode(',', $tagsCsv);
    // will split the array in tagsCsv into an array of individual tags separated by columns
@endphp

 

<ul class="flex">
    @foreach ($tags as $tag)
    <li
        class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
    >
        <a href="/?tag={{$tag}}">{{$tag}}</a>
        {{-- setting the link to dynamically change the tag in the url
        the tag is fetched from the database --}}
    </li> 
    @endforeach
</ul>