@if($allOption)
    <label for="experience_levels" class="mb-1 flex items-center">
        <input type="radio" name="{{$name}}" id="" value="" @checked(!request($name)) >
        <span class="ml-2">All</span>
    </label>
@endif
@foreach ($options as $level)
<label for="experience_level_{{ $level }}" class="mb-1 flex items-center">
    <input type="radio" name="{{$name}}" id="{{$name}}_{{ $level }}" value="{{$value ?? $level}}"
    @checked($level === ($value ?? request($name)))>
    <span class="ml-2">{{Str::ucfirst($level)}}</span>
</label>
@endforeach

@error($name)
<div class="mt-4 text-red-500">{{$message}}</div>
@enderror
