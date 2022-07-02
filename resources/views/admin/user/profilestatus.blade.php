<div class="row">
    <div class="col-md-12">
        <h3>Welcome, {{ ucfirst($user->firstname).' '.ucfirst($user->lastname) }}!</h3>
        @if ($user->last_login_at!='')
        Your last visit was <strong class="badge badge-pill" style="background-color:rgb(10, 122, 150); color:seashell">{{ date('D d F, Y h:ia',strtotime($user->last_login_at)) }}</strong>
        @else
        <p class="badge badge-pill" style="background-color: rgb(10, 122, 150); color:seashell">You are logging in for the first time.</p>
        @endif
        <hr>

        <div><span class="fa fa-briefcase"></span> <strong>{{ implode(', ',$user->roles()->get()->pluck('name')->toArray()) }}</strong></div>
        <div><span class="fa fa-th"></span> {{ $user->staffcategory->name }}</div>
        <div><span class="fa fa-phone"></span> {{ $user->phone }}</div>
        <div><span class="fa fa-envelope"></span> {{ $user->email }}</div>
        <div><span class="fa fa-clock-o"></span> {{ date('D d F, Y h:ia',strtotime($user->created_at)) }} [Date created]</div>
        <div><span class="fa fa-map-marker"></span> {{$user->location->name}}</div>
        <div>
            Account Status
            @if ($user->isactive==1)
            <span class="badge badge-success badge-pill"
                style="background-color: green; color:seashell"> Active</span>
            @else
            <span class="badge badge-danger badge-pill"
                style="background-color: crimson; color:seashell"> Inactive</span>

            @endif
        </div>
        <div>
           Profile Updated?
            @if ($user->profileupdated==1)
            <span class="badge badge-success badge-pill"
                style="background-color: green; color:seashell"> Yes</span>
            @else
            <span class="badge badge-danger badge-pill"
                style="background-color: crimson; color:seashell"> No</span>

            @endif
        </div>


        <hr>

        @if ($user->profileupdated==1)
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Personal Quick Tour</div>
                        <div class="panel-body">

                            <a href="{{ route('edit.staff.details',$user->id) }}"
                                class="btn btn-warning btn-sm btn-block"><span class="fa fa-pencil"></span> Edit
                                Details
                            </a>
                            <a href="{{ route('staff.show',$user->id) }}"
                                class="btn btn-primary btn-sm btn-block"><span class="fa fa-eye"></span> More
                                Details
                            </a>
                            <a href="" data-toggle="modal" data-target="#modal-default"
                                class="btn btn-success btn-sm btn-block"><span class="fa fa-lock"></span> Change
                                Password
                            </a>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @if ($user->staffcategory_id==1 || $user->staffcategory_id==2)
                    <div class="panel panel-default">
                        <div class="panel-heading">Assessment Quick Tour</div>
                        <div class="panel-body">
                            <a href="{{ route('publishedcomptass') }}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-bullhorn"></i> Published Assessment</a>
                            <a href="{{ route('submitted.comptass') }}" class="btn btn-success btn-sm btn-block"><i class="fa fa-file-text-o"></i> Submitted Assessment</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        @endif


        {{-- Password change input modal area --}}
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">

                    <form action="{{ route('password.change') }}" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><span class="fa fa-lock"></span> Change Password</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="">New Password <strong style="color:red;">*</strong></label>
                                    <input type="password" class="form-control" name="password"
                                        value="{{ old('password') }}" required placeholder="New password"
                                        autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password <strong style="color:red;">*</strong></label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" placeholder="Confirm Password" required
                                        autocomplete="new-password">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->

                    </form>
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

    </div>
</div>


