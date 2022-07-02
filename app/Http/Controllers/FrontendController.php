<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $ourmission='
        To be a world-class organization renowned for excellence in
    Oil spill Emergency Management and capacity building for
    its members.
    In pursuit of its vision, CNA
    develops and maintains a highly competent and motivated
    workforce that guarantees safety and business continuity during
    oil spill emergencies.
    CNA provides a wide range of proactive training and consultancy
    services in oil spill response preparedness and assurance.
    ';
    $ourvision='
    To be a world-class organization renowned for excellence in
    Oil spill Emergency Management and capacity building for
    its members.
    ';
    $gmstatement='
    Since incorporation in September
                                            2000, Clean Nigeria Associates has built world class expertise in
                                            Onshore, Swamp and Offshore Tier 2 Oil Spill Response,
                                            with capability to provide invaluable support for Tier 3 Oil
                                            Spill response. Our capability and effectiveness earned us recognition
                                            in the National Oil Spill Contingency Plan (NOSCP) as Nigeria’s Tier 2
                                            Oil Spill responder. We have very competent workforce and reliable
                                            equipment to deliver value to member companies and the public.
                                            Our Team of Professionals have the right attitude to Emergency
                                            response, Oil Spill response in particular.
                                            Clean Nigeria Associates drives Oil Spills Response
                                            Competence Development and Process Assurance for member
                                            companies, including free Training & Audits.

                                            Our vision is to become AFRICA’s Center of Excellence in the Oil and Gas sector, renowned for transfer of Oil Spill Response management skills and technology.

                                            Our RESPONSE and development teams are made up of Industry experts on a mission to transfer
                                            knowledge and mentor young professionals for sustainable development.
                                            You are welcome to explore our website www.cleannigeria.org to
                                            acquaint yourself with the many values we bring to sustainable Oil &
                                            Gas exploration in Nigeria.
    ';

    $news = News::where('isapproved','1')->latest()->take(5)->get();

    
        return view('frontend.index',compact('ourmission','ourvision','gmstatement','news'));
    }

}
