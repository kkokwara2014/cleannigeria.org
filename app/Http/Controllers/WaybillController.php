<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Waybill;
use App\Models\Waybillitem;
use App\Models\Waybilllocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WaybillController extends Controller
{

    public $approvers;
    public function __construct(){
        $this->approvers=User::with(['roles'])->whereHas('roles', function($query) {
            $query->where('name', '=', 'Accounts & Admin Manager')
                ->orWhere('name', '=', 'Admin')
                ->orWhere('name', '=', 'East Regional Supervisor')
                ->orWhere('name', '=', 'West Regional Supervisor');
        })->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waybills=Waybill::with(['waybilllocation','waybillitems','user'])->latest()->get();
        return view('admin.waybills.index',array('user'=>Auth::user()),compact('waybills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $waybilllocations=Waybilllocation::orderBy('name','asc')->get();
        $approvers=$this->approvers;
        $receivers=User::orderBy('firstname','asc')->get();
        return view('admin.waybills.create',array('user'=>Auth::user()),compact('waybilllocations','approvers','receivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        DB::transaction(function () use($request) {
            
            $waybill=new Waybill();
            $waybill->user_id=auth()->user()->id;
            $waybill->waybilllocation_id=$request->waybilllocation_id;
            $waybill->waybillnum=rand(2345,6789);
            $waybill->destination=$request->destination;
            $waybill->vehiclenum=$request->vehiclenum;
            $waybill->receiver_id=$request->receiver_id;
            $waybill->approver_id=$request->approver_id;
            $waybill->save();
            //saving the waybill details
            foreach ($request->description as $key=> $value) {
                $data=array(
                    'issuenum'=>$request->issuenum,
                    'description'=>$request->description, 
                );
                            
               
                $waybill->waybillitems()->create([
                    'issuenum'=>$data['issuenum'][$key],
                    'description'=>$data['description'][$key],
                ]);
            }

            //notify approver via SMS
            SMSController::sendWaybillToStaffSMS($waybill);
            SMSController::sendWaybillToApproverSMS($waybill);
            
        });


        
        return redirect()->route('waybills.index')->with('success','Waybill saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Waybill  $waybill
     * @return \Illuminate\Http\Response
     */
    public function show(Waybill $waybill)
    {
        return view('admin.waybills.show',array('user'=>Auth::user()),compact('waybill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Waybill  $waybill
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $waybill=Waybill::with(['waybillitems'])->where('id',$id)->first();
       $waybilllocations=Waybilllocation::orderBy('name','asc')->get();
       $approvers=$this->approvers;
        $receivers=User::orderBy('firstname','asc')->get();
        return view('admin.waybills.edit',array('user'=>Auth::user()),compact('waybilllocations','approvers','waybill','receivers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Waybill  $waybill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function () use($request,$id) {
            
            $waybill= Waybill::find($id);
            $waybill->user_id=auth()->user()->id;
            $waybill->waybilllocation_id=$request->waybilllocation_id;
            $waybill->waybillnum=$request->waybillnum;
            $waybill->destination=$request->destination;
            $waybill->vehiclenum=$request->vehiclenum;
            $waybill->receiver_id=$request->receiver_id;
            $waybill->approver_id=$request->approver_id;
            $waybill->save();

            //delete the existing waybill items
           Waybillitem::where('waybill_id',$waybill->id)->delete();
           
            
            //saving the waybill details
            foreach ($request->description as $key=> $value) {
                                
                $data=array(
                    'issuenum'=>$request->issuenum,
                    'description'=>$request->description, 
                );

                $waybill->waybillitems()->create([
                    'issuenum'=>$data['issuenum'][$key],
                    'description'=>$data['description'][$key],
                ]);

            }
            
        });
        
        return redirect()->route('waybills.index')->with('success','Waybill updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Waybill  $waybill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waybill $waybill)
    {
        $waybill->delete();
        return redirect()->back()->with('deleted','Waybill with ref #'.$waybill->waybillnum.' deleted successfully!');
    }

    public function autocomplete(Request $request){
        
        if($request->ajax()) {
            $data = Waybill::where("vehiclenum","LIKE",'%'.$request->searchtext.'%')
            ->get();
           
            $output = '';
           
            if (count($data)>0) {
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                foreach ($data as $row){
                    $output .= '<a href="#"><li class="list-group-item">'.$row->vehiclenum.'</li></a>';
                }
                $output .= '</ul>';
            }else {
                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
           
            return $output;
        }

    }

    public function giveapproval($id){
        $waybill=Waybill::find($id);
        $waybill->isapproved=1;
        $waybill->save();

        return redirect()->back()->with('success','Waybill with '.$waybill->waybillnum.' has been approved successfully!');
    }

}
