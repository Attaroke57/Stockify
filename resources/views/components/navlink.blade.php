<a {{ $attributes }}
    class="{{ $active ? 'bg-yellow-300 text-black' : 'text-gray-300 hover:bg-yellow-300 hover:text-black' }} rounded-md px-2 py-2 text-sm font-medium"
    aria-current={{ $active ? 'page ' : false }}>{{ $slot }}</a>
