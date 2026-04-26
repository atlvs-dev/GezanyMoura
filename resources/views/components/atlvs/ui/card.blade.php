<div {{ $attributes->merge([
    'class' => '
        bg-white
        rounded-lg
        border border-slate-200
        shadow-sm
        overflow-hidden
    '
]) }}>
    @isset($header)
        <div class="px-4 sm:px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            {{ $header }}
        </div>
    @endisset

    <div class="px-4 sm:px-6 py-5">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="px-4 sm:px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $footer }}
        </div>
    @endisset
</div>
