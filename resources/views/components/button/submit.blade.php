<button type="submit" {{ $attributes->merge(['class' => 'btn btn-primary']) }}>
    <i class="ti ti-device-floppy"></i>
    <span class="ms-2">{{ $title }}</span>
    <span>{{ $slot }}</span>
</button>
