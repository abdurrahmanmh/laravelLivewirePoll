<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePoll extends Component
{
    #[Validate]
    public $title;
    
    #[Validate]
    public $options = ['First'];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:1|max:255',
        'options.*' => 'required|min:1|max:255'
    ];

    protected $messages =[
        'options.*.required' => 'Option cannot be empty'
    ];

    
    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption(){
        $this->options[] = '';
        $this->validateOnly('options');
    }

    public function removeOption($index){
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    // public function updated($propertyName){
    //     $this->validateOnly($propertyName);
    // }

    public function createPoll(){
        $this->validate();


        Poll::create([
            'title' => $this->title
        ])->options()->createMany(
            collect($this->options)->map(fn($option)
            => ['name' => $option])->all()
        );

        // foreach($this->options as $optionName){
        //     $poll->options()->create([
        //         'name' => $optionName
        //     ]);
        // }

        $this->reset(['title', 'options']);
    }

    // public function mount(){

    // }
}
