<nav {{$attributes}}>
    <ul class="flex space-x-2 text-slate-500">
        <li><a href="/"></a>Home</li>
        <li>➔</li>
        <li><a href="{{route('jobs.index')}}">Jobs</a></li>
        <li>➔</li>
        <li>{{$job->title}}</li>
    </ul>
</nav>
