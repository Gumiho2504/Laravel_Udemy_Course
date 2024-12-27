<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public  $title = '';
    public $options = [''];

    protected $rules = [
        'title'=> 'required|string|min:3|max:255',
        'options' => 'required|array|min:2|max:10',
        'options.*' => 'required|string|min:3|max:255'
    ];

    protected $messages = [
        'options.*.required'=> "The Option can't be empty"
    ];

    public function render()
    {
        return view('livewire.create-poll');
    }

    public function update($propertyName){
        $this->validateOnly($propertyName );
    }

    public function addOption(){
        $this->options[] = '';
    }


    public function removeOption ($optins){
        unset($this->options[$optins]);
        $this->options = array_values($this->options);
    }


    public function createPoll(){
        $this->validate();
        Poll::create([
            'title' => $this->title,
        ])->options()->createMany(
            collect($this->options)->map(callback: fn ($option)
                => [
                    'name' => $option,
                ]
            )->all()
        );

        // foreach($this->options as $option){
        //     $poll->options()->create([
        //         'name' => $option,
        //     ]);
        // }

        $this->reset(['title','options']);


        // trigger when event create at new poll to view
         $this->dispatch('pollCreated');


    }

}
