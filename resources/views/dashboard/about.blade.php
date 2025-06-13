@php
    $about = \App\Models\StaticContent::where('section', 'about')->first();
@endphp
@livewire('navbar')
<div class="about-section">
    {!! $about?->content !!}
</div>




