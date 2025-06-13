@php
    $contacto = \App\Models\StaticContent::where('section', 'contact')->first();
@endphp

<div class="contact-section">
    {!! $contacto?->content !!}
</div>


