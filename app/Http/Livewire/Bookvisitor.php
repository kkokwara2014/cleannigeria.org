<?php

namespace App\Http\Livewire;

use App\Models\Visitorbooking;
use Livewire\Component;

class Bookvisitor extends Component
{
    public $bookingnum;
    public $visitorname;
    public $visitingdate;
    public $visitingtime;
    public $purpose;

    public function mount(){
        $this->bookingnum=rand(234567,890123);
    }

    protected $rules=[
        'visitorname'=>['required','min:3'],
        'visitingdate'=>['required'],
        'visitingtime'=>['required'],
        'purpose'=>['required'],
    ];

    public function updated($property){
        $this->validateOnly($property);
    }
    public function storebookedvisitor(){

        Visitorbooking::create([
            'bookingnum'=>$this->bookingnum,
            'visitorname'=>$this->visitorname,
            'visitingdate'=>$this->visitingdate,
            'visitingtime'=>$this->visitingtime,
            'purpose'=>$this->purpose,
            'user_id'=>auth()->user()->id,
        ]);
        
        // $this->emit('visitorbooked');
        session()->flash('success','Your visitor has been booked successfully!');
        $this->reset();
    }
    public function render()
    {
        return view('livewire.bookvisitor');
    }
}
