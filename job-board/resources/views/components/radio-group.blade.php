<label for="experience_levels" class="mb-1 flex items-center">
    <input type="radio" name="{{$name}}" id="" value="" @checked(!request($name)) >
    <span class="ml-2">All</span>
</label>
@foreach ($options as $level)
<label for="experience_level_{{ $level }}" class="mb-1 flex items-center">
    <input type="radio" name="{{$name}}" id="{{$name}}_{{ $level }}" value="{{ $level }}" @checked($level === request($name))>
    <span class="ml-2">{{Str::ucfirst($level)}}</span>
</label>
@endforeach
