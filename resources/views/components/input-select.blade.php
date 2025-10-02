@props([
    'placeholder' => null,
    'trailingAddOn' => null,
    'multiple' => null,
])

<div class="flex">

  <select {{ $attributes->merge(['class' => 'bg-white rounded text-sm w-full' . ($trailingAddOn ? ' rounded-r-none' : '')]) }} @if($multiple) multiple @endif>

    @if ($placeholder)

        <option disabled value="">{{ $placeholder }}</option>

    @endif

    {{ $slot }}

  </select>

  @if ($trailingAddOn)

    {{ $trailingAddOn }}

  @endif

</div>
