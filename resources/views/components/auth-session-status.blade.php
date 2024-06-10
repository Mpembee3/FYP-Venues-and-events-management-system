@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-weight-bold text-sm text-success']) }}>
        {{ $status }}
    </div>
@endif
