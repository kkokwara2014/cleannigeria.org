<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('user_images',$user->userimage)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{$user->lastname.' '.$user->firstname}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">



            @if ($user->profileupdated==1)
            <li>
                <a href="{{route('dashboard.index')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        {{-- <i class="fa fa-angle-left pull-right"></i> --}}
                    </span>
                </a>
                
            </li>

            <li><a href="{{route('user.profile')}}"><i class="fa fa-picture-o"></i> Profile Picture</a></li>

            @endif
            
            
            @if ($user->profileupdated==1 && ($user->staffcategory_id==1 || $user->staffcategory_id==2) )
            {{-- frontend --}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bullseye"></i>
                    <span>Frontend for Public</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('gallery.index') }}"><i class="fa fa-circle-o"></i> <span>Gallery
                            </span></a></li>
                    <li><a href="{{ route('keypersonnel.index') }}"><i class="fa fa-circle-o"></i> <span>Key
                                Personnel
                            </span></a></li>
                    <li><a href="{{ route('membcompany.index') }}"><i class="fa fa-circle-o"></i> <span>Member
                                Company
                            </span></a></li>
                    <li><a href="{{ route('service.index') }}"><i class="fa fa-circle-o"></i>
                            <span>Services</span></a>
                    </li>
                    <li><a href="{{ route('news.index') }}"><i class="fa fa-circle-o"></i> <span>CNA News</span></a>
                    </li>
                </ul>
            </li>

            



            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span>SR Equipment</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('category.index') }}"><i class="fa fa-th"></i> Category</a></li>
                    <li><a href="{{ route('location.index') }}"><i class="fa fa-map-marker"></i> Location</a>
                    </li>
                    <li><a href="{{ route('store.index') }}"><i class="fa fa-university"></i> Store</a></li>

                    <li><a href="{{url('dashboard/equipment/unapproved')}}"><i class="fa fa-circle-o"></i>
                            <span>Unapproved
                            </span></a></li>
                    <li><a href="{{url('dashboard/equipment/approved')}}"><i class="fa fa-circle-o"></i>
                            <span>Approved
                            </span></a></li>
                    <li><a href="{{url('dashboard/equipment')}}"><i class="fa fa-circle-o"></i>
                            <span>All</span></a>
                    </li>

                    {{-- amendment --}}
                    <li><a href="{{ route('replenish.index') }}"><i class="fa fa-refresh"></i> Replenish</a>
                    </li>
                    <li><a href="{{ route('transfer.index') }}"><i class="fa fa-exchange"></i> Transfer</a></li>
                    <li><a href="{{ route('maintenance.index') }}"><i class="fa fa-wrench"></i> Maintenance</a>
                    </li>
                    <li><a href="{{ route('scrap.index') }}"><i class="fa fa-archive"></i> Scraps</a></li>

                    <li><a href=""><i class="fa fa-file-pdf-o"></i> Manuals</a></li>
                </ul>
            </li>

            <li><a href="{{ route('mobilizationrequest.index') }}"><i class="fa fa-tint"></i> Mobilization
                    Request</a></li>

            <li><a href="{{ route('supplier.index') }}"><i class="fa fa-user-circle-o"></i> Supplier</a>
            </li>
            <li><a href="{{ route('contact.index') }}"><i class="fa fa-envelope"></i> Contacts</a></li>
            
            {{-- Hazard Module --}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bug"></i>
                    <span>Hazards</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('hazardreports.index') }}"><i class="fa fa-bug"></i> Reports</a>
                    </li>
                </ul>
            </li>

            {{-- Periodic maintenance Module --}}
            {{-- <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-wrench"></i>
                                    <span>Periodic Maintenance</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('machines.index') }}"><i class="fa fa-tags"></i> Machines</a>
            </li>
            <li><a href="{{ route('schedules.index') }}"><i class="fa fa-calendar-check-o"></i>
                    Schedules</a></li>
            <li><a href="{{ route('machinemaints.index') }}"><i class="fa fa-file-text-o"></i>
                    Machine Maintenance</a></li>
        </ul>
        </li> --}}

        {{-- Equipment Maintenance  --}}
        <li class="treeview">
            <a href="#">
                <i class="fa fa-wrench"></i>
                <span>Equipment Maintenance</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{ route('select.maintoption') }}"><i class="fa fa-calendar-check-o"></i> Schedule
                        Maintenance</a>
                </li>
                <li>
                    <a href="{{ route('vendors.index') }}"><i class="fa fa-users"></i> Vendors</a>
                </li>
                <li>
                    <a href="{{ route('workorder.index') }}"><i class="fa fa-money"></i> Work Orders</a>
                </li>
                <li>
                    <a href="{{ route('maintenanceschedule.index') }}"><i class="fa fa-calendar-check-o"></i>
                        Schedules</a>
                </li>
                {{-- <li>
                                        <a href="{{ route('maintainedequipment.index') }}"><i class="fa fa-ticket"></i>
                Maintained Equipment</a>
                </li> --}}
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-adn"></i>
                <span>CNA</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('staff.index') }}"><i class="fa fa-users"></i> Staff</a></li>
                <li><a href="{{ route('directory.index') }}"><i class="fa fa-book"></i>
                        Directory</a>
                </li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-hotel"></i>
                <span>Leave</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('leave.index') }}"><i class="fa fa-hotel"></i> Make Request</a>
                </li>
                <li><a href="{{ route('all.approvedleaves') }}"><i class="fa fa-hotel"></i> Approved</a>
                </li>
                <li><a href="{{ route('allapprovedleaves') }}"><i class="fa fa-hotel"></i> All Approved</a>
                </li>
            </ul>
        </li>

        <li><a href="{{ route('employees.index') }}"><i class="fa fa-info-circle"></i> Employee
                Information</a></li>


        <li class="treeview">
            <a href="#">
                <i class="fa fa-key"></i>
                <span>Competence Assessment</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                @if (Auth::user()->profileupdated==1 && (Auth::user()->hasAnyRole('Super Admin') ||
                Auth::user()->hasAnyRole('General Manager'))) 
                    <li><a href="{{ route('competenceassessment.index') }}"><i
                            class="fa fa-key"></i> Created</a>
                </li>
                @endif
                <li><a href="{{ route('publishedcomptass') }}"><i class="fa fa-bullhorn"></i>
                        Published</a></li>

                {{-- <li><a href="{{ route('submitted.comptass') }}"><i class="fa fa-file-text-o"></i>
                        Submitted</a></li> --}}
                        
               @if (auth()->user()->hasAnyRole(['Admin'])||auth()->user()->hasAnyRole(['General Manager']))
                <li><a href="{{ route('select.comptass.year') }}"><i class="fa fa-file-text-o"></i>
                        All Submitted</a></li>
               @endif

                <li><a href="{{ route('comptassbyyou') }}"><i class="fa fa-file-text-o"></i>
                        Submitted by You</a>
                </li>
                <li><a href="{{ route('comptassforyou') }}"><i class="fa fa-file-text-o"></i>
                        Submitted for You</a>
                </li>

                <li><a href="{{ route('senttosuperior') }}"><i class="fa fa-file-text-o"></i>
                        Submitted for Reassessment</a>
                </li>
                
                <li><a href="{{ route('senttogm') }}"><i class="fa fa-file-text-o"></i>
                        Submitted for Final Assessment</a>
                </li>
            </ul>
        </li>

        {{-- for trainee certificate --}}
       
        <li class="treeview">
            <a href="#">
                <i class="fa fa-certificate"></i>
                <span>Trainee Certificates</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('trainees.index') }}"><i class="fa fa-user-plus"></i> Trainees</a></li>
                <li><a href="{{ route('trainings.index') }}"><i class="fa fa-calendar-check-o"></i> Trainings</a>
                </li>
                <li><a href="{{ route('certificates.index') }}"><i class="fa fa-certificate"></i> Certificates</a>
                </li>
            </ul>
        </li>

        {{-- for Master document register --}}
        <li class="treeview">
            <a href="#">
                <i class="fa fa-book"></i>
                <span>Master Document Register</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('documentregisters.index') }}"><i class="fa fa-file-pdf-o"></i>
                        Documents</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ route('waybills.index') }}"><span class="fa fa-exchange"></span> Waybills</a>
        </li>
        <li>
            <a href="{{ route('visitorbookings.index') }}"><span class="fa fa-users"></span> Visitor Bookings</a>
        </li>

         {{-- only Admin --}}
         @if(auth()->user()->hasAnyRole(['Admin']))
         <li class="treeview">
             <a href="#">
                 <i class="fa fa-cogs"></i>
                 <span>Settings</span>
                 <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                 </span>
             </a>
             <ul class="treeview-menu">
                 <li><a href="{{ route('manageusers.index') }}"><i class="fa fa-user"></i> User Management</a></li>
                 <li><a href="{{ route('login.details') }}"><i class="fa fa-user"></i> Login Trail</a></li>
                 
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Biometric Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                       </span>
                   </a>
                   
                   <ul class="treeview-menu">
                       <li><a href="{{ route('bio.home') }}"><i class="fa fa-user"></i> User Biometrics</a></li>
                       <li><a href="{{ route('scanner.locations') }}"><i class="fa fa-user"></i> Scanner Locations</a></li>
                       <li><a href="{{ route('timesheet.report') }}"><i class="fa fa-user"></i> Timesheet Report</a></li>
                   </ul>
           </li>
         @endif

        @endif


       @if (($user->profileupdated==1 && $user->staffcategory_id==3) || auth()->user()->hasAnyRole(['Admin'])  || auth()->user()->hasAnyRole(['General Manager']) || auth()->user()->hasAnyRole(['Maintenance Officer']))
           {{-- CNA Partners --}}
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dot-circle-o"></i>
                <span>CNA Partners</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('cnapartners.index') }}"><i class="fa fa-users"></i> Partners</a></li>
                <li><a href="{{ route('maintenancerequest.index') }}"><i class="fa fa-wrench"></i> Request Maintenance</a></li>
            </ul>
        </li>
        {{-- end of partners --}}
       @endif
        

        <li>
            <a href="{{ route('user.logout') }}"><span class="fa fa-sign-out"></span> Sign out</a>
        </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>