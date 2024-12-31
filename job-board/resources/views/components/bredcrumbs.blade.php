<nav {{$attributes}}>
    <ul class="flex space-x-2 text-slate-500">
        <li><a href="/"></a>Home</li>

        @foreach ($links as $label => $link)
            <li>➔</li>
            <li><a href="{{$link}}">{{$label}}</a></li>

        @endforeach

        {{-- <li>{{$job->title}}</li> --}}
    </ul>
</nav>
