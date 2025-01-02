<div class="relative">

@if($formRef)
        <button class="absolute right-0 top-0 h-full flex items-center pr-2"
        @click="$refs['input-{{$name}}'].value = '';$refs['{{$formRef}}'].submit();">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-slate-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>

        </button>
@endif


    <input x-ref="input-{{$name}}" type="{{$type}}" name="{{ $name }}" value="{{ $value }}" id="{{$name}}" placeholder="{{$placeholder}}"
    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm pr-8">

</div>
