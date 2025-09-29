@props(['type' => 'success','title' => 'Thông báo'])

<div >
    <strong>{{ $title }}:</strong> {{ $slot }}
</div>
