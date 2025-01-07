<?php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Poll;
use Livewire\Component;
use Livewire\Attributes\On;

class Polls extends Component
{
    
    //protected $listeners = ['pollCreated' => '$refresh'];

    #[On('pollCreated')]
    public function render()
    {
        $polls = Poll::with('options.votes')->latest()->get();


        return view('livewire.polls',['polls' => $polls]);

    }

    // public function vote($optionId){
    //     $option = Option::find($optionId);
    //     $option->votes()->create();
    // }

    public function vote(Option $option)  {
        $option->votes()->create();
    }


}
