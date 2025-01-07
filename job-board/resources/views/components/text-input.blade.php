<div class="relative">

    @if('textarea' != $type)
        @if($formRef)
        <button class="absolute right-0 top-0 h-full flex items-center pr-2"
        @click="$refs['input-{{$name}}'].value = '';$refs['{{$formRef}}'].submit();">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-slate-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>

        </button>
        @endif


        <input x-ref="input-{{$name}}" type="{{$type}}" name="{{ $name }}" value="{{ old($name,$value) }}" id="{{$name}}" placeholder="{{$placeholder}}"
        @class([
            'block w-full rounded-md  shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm',
            'pr-8' => $formRef,
            'border-gray-300' => ! $errors->has($name),
            'border-red-500' => $errors->has($name),
            ])>
    @else
        <textarea name="input-{{$name}}" id="{{$name}}" cols="30" rows="10"
        @class([
            'block w-full rounded-md  shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm',
            'pr-8' => $formRef,
            'border-gray-300' => ! $errors->has($name),
            'border-red-500' => $errors->has($name),
            ])
        > {{old($name,$value)}} </textarea>
    @endif


    @error($name)
        <div class="mt-4 text-red-500">{{$message}}</div>
    @enderror
</div>
