<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessmentuser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //greeting module
        $greeting='';
        $timeofDay=date('H');
        if($timeofDay<'12'){
            $greeting='Good morning';
        }elseif($timeofDay>='12' && $timeofDay<'17'){
            $greeting='Good afternoon';
        }elseif($timeofDay>='17' && $timeofDay<'19'){
            $greeting='Good evening';
        }elseif($timeofDay>='19'){
            $greeting='It\'s night';
        }

        $countsalesstaff=User::with(['roles'])->whereHas('roles', function($query) {
            $query->where('name', '=', 'Sales Person');
        })->count();



        $mysubmittedcomptassments=Competenceassessmentuser::with(
            ['user',
            'competenceassessment'
            ])->where('user_id',auth()->user()->id)
            ->orderBy('id','desc')
            ->count();

        $submittedcomptassforme=Competenceassessmentuser::with(
            ['user',
            'competenceassessment'
            ])->where('sentto_id',auth()->user()->id)
            ->orderBy('id','desc')
            ->count();

            $submittedcomptassforsuperior=Competenceassessmentuser::with(
                ['user',
                'competenceassessment'
                ])->where('senttosuperior_id',auth()->user()->id)
                ->orderBy('id','desc')
                ->count();

                $submittedcomptassforgm=Competenceassessmentuser::with(
                    ['user',
                    'competenceassessment'
                    ])->where('finalassessor_id',auth()->user()->id)
                    ->orderBy('id','desc')
                    ->count();

        // return view('home');
        return view('admin.index',array('user'=>Auth::user()),compact(
            'greeting',
            'mysubmittedcomptassments',
            'submittedcomptassforme',
            'submittedcomptassforsuperior',
            'submittedcomptassforgm',
        ));
    }
}
