<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}}>
    {{$slot}}   
    {{-- anything you place inside this card component will be displayed 
    thanks to the $slot variable - the div will expect some content to be place within it  --}}
</div>