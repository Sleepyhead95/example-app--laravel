@props(['listing'])
{{-- props is the data want want to pass into the component - it comes from the parent view and makes
the info available to the component --}}

<!-- we paste the data from our route into html elements in this view: -->
<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{$listing->logo ? asset('storage/'. $listing->logo) : asset('/images/no-image.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
            <x-listing-tags :tagsCsv="$listing->tags"></x-listing-tags>
            {{-- we pass in the component and the variable we want to get and display from the DB --}}
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i>{{$listing->location}}
            </div>
        </div>
    </div>
</x-card>