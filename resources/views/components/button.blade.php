<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary', 'style'=> 'width:33rem']) }}>
    {{ $slot }}
</button>
