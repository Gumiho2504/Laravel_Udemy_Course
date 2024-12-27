<div>
    <form wire:submit.prevent="createPoll">
        <label> Poll Title</label>
        <input type="text" wire:model.lazy="title">
        <div class=" text-red-500">
            @error('title')
                {{ $message }}
            @enderror
        </div>
        <div class="my-4">
            <button class="btn" wire:click.prevent="addOption">Add Option</button>
        </div>

        <div class="mt-4">
            @foreach ($options as $index => $option)
                <div class="mb-2">
                    <label> Option {{ $index + 1 }}</label>
                    <div class="flex gap-2">
                        <input type="text" wire:model.lazy="options.{{ $index }}">

                        <button class="btn" wire:click.prevent="removeOption({{ $index }})">Remove</button>

                    </div>
                    @error("options.{$index}")
                    <div class="text-red-500">{{ $message }}</div>
                  @enderror

                </div>
            @endforeach
        </div>
        <div class=" text-red-500">
            @error("options")
                {{ $message }}
            @enderror
        </div>


        <div class="my-4">
            <button type="submit" class="btn">Create Poll</button>
        </div>
    </form>



</div>
