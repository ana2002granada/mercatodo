@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'origin-top-left left-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'right':
    default:
        $alignmentClasses = 'origin-top-right';
        break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
}
@endphp

<dropdown
    alignment-classes="{{$alignmentClasses}}"
    width="{{$width}}"
    content-classes="{{$contentClasses}}"
>
    <template v-slot:trigger>
        {{ $trigger }}
    </template>
    {{$content}}
</dropdown>
