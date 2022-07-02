<?php

namespace App\Http\Livewire;

use App\Models\Visitorbooking;
use Livewire\Component;
use Livewire\WithPagination;

class VisitorbookingComponent extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    
    // protected $listeners=[
    //     'visitorbooked'=>'$refresh',
    // ];
    public $perpage=10;
    public $search='';
    public function render()
    {
        return view('livewire.visitorbooking-component',[
            'visitorbookings'=>Visitorbooking::search($this->search)
                ->orderBy('created_at','desc')->simplePaginate($this->perpage)
        ]);
    }
}
