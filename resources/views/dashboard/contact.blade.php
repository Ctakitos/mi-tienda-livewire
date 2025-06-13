@php
    $contact = \App\Models\StaticContent::where('section', 'contact')->first();
@endphp

<div class="contact-section">
    {!! $contact?->content !!}
</div>
