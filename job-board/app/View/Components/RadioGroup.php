<?php

namespace App\View\Components;

use App\Models\Work;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array $options ,
        public ?bool $allOption = true,
        public ?string $value = null,
    ){}

    /**
     * Get the view / contents that represent the component.
     */

     public function optionsWithLabels(): array{
        return array_is_list($this->options) ?
        array_combine(array_keys($this->options), array_values($this->options)) : $this->options;
     }
    public function render(): View|Closure|string
    {
       // $this->options = Work::$experience_lavels;
        return view('components.radio-group');
    }
}
