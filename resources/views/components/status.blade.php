<div class="flex flex-grow items-center gap-3">
    @if($payment->isSuccessful())
        <svg height="100" viewBox="0 0 361 361" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M180.5 361C280.187 361 361 280.187 361 180.5C361 80.8126 280.187 0 180.5 0C80.8126 0 0 80.8126 0 180.5C0 280.187 80.8126 361 180.5 361Z" fill="#37D11E"/>
            <path d="M163.45 250C159.377 250.007 155.412 248.677 152.153 246.21L151.951 246.057L109.404 213.2C107.433 211.675 105.78 209.773 104.537 207.603C103.295 205.433 102.488 203.037 102.163 200.552C101.838 198.067 102.001 195.542 102.642 193.12C103.284 190.699 104.392 188.428 105.902 186.439C107.413 184.45 109.297 182.78 111.447 181.526C113.597 180.272 115.97 179.458 118.432 179.129C120.893 178.801 123.395 178.965 125.794 179.613C128.192 180.261 130.441 181.379 132.412 182.904L159.97 204.238L225.093 118.471C226.603 116.483 228.487 114.814 230.636 113.56C232.785 112.307 235.157 111.492 237.618 111.164C240.078 110.836 242.579 111.001 244.977 111.648C247.374 112.295 249.622 113.413 251.592 114.938L251.597 114.942L251.193 115.509L251.608 114.942C255.582 118.025 258.182 122.574 258.837 127.59C259.493 132.606 258.15 137.68 255.104 141.698L178.505 242.534C176.733 244.857 174.455 246.737 171.847 248.028C169.239 249.319 166.371 249.986 163.466 249.977L163.45 250Z" fill="white"/>
        </svg>
        <h1 class="h-6 font-bold uppercase">{{ trans('payments.invoice.approved') }}</h1>
    @elseif($payment->isUnprocessed())
        <svg height="100" viewBox="0 0 361 361" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M180.5 361C280.187 361 361 280.187 361 180.5C361 80.8126 280.187 0 180.5 0C80.8126 0 0 80.8126 0 180.5C0 280.187 80.8126 361 180.5 361Z" fill="#C4C4C4"/>
            <ellipse cx="181.5" cy="180" rx="163.5" ry="162" fill="#C4C4C4"/>
            <ellipse cx="181.5" cy="180" rx="163.5" ry="162" fill="black" fill-opacity="0.2"/>
            <line x1="174.131" y1="110.868" x2="174.868" y2="205.869" stroke="white" stroke-width="34" stroke-linecap="round"/>
            <line x1="179.83" y1="206.928" x2="241.758" y2="229.755" stroke="white" stroke-width="34" stroke-linecap="round"/>
        </svg>
        <h1 class="h-6 font-bold">{{ trans('payments.invoice.pending') }}</h1>
    @else
        <svg height="100"  viewBox="0 0 361 361" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M180.5 361C280.187 361 361 280.187 361 180.5C361 80.8126 280.187 0 180.5 0C80.8126 0 0 80.8126 0 180.5C0 280.187 80.8126 361 180.5 361Z" fill="#D81010"/>
            <line x1="118.042" y1="119.25" x2="254.501" y2="255.709" stroke="white" stroke-width="34" stroke-linecap="round"/>
            <line x1="107.25" y1="255.459" x2="243.71" y2="119" stroke="white" stroke-width="34" stroke-linecap="round"/>
        </svg>
        <h1 class="h-6 font-bold">{{ trans('payments.invoice.rejected') }}</h1>
    @endif
</div>
