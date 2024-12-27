<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
class Polls extends Component
{

    // listeners from CreatePoll componet emit pollCreated and call rander mothod
    // in the poll component
    //protected $listeners = ["pollCreated"=> 'render'];

    #[On('pollCreated')]
    public function render()
    {
        $polls = \App\Models\Poll::with('options.votes')->latest()->get();

        return view('livewire.polls',compact('polls'));
    }

    public function vote($optionId){
        $option = \App\Models\Option::findOrFail($optionId);
        $option->votes()->create();
    }
}
