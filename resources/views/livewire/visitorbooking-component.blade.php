<div>

    {{-- @if ($visitorbookings->count()) --}}
    <div class="form-group">
        <input type="text" class="form-control" wire:model.debounce.300ms="search" placeholder="Search booked Visitors">
    </div>

    <table class="table table-light table-responsive">
        <div class="row">
            <div class="col-md-1">
                <select wire:model='perpage' class="form-control">
                    {{-- <option value="3">3</option> --}}
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <thead class="thead-light">
            <tr>
                <th>Booking No.</th>
                <th>Visitor</th>
                <th>Visiting Date</th>
                <th>Visiting Time</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>Booked by</th>
                <th></th>
            </tr>
        </thead>
        <tbody wire:poll.15000ms>
            @foreach ($visitorbookings as $vbooking)
            @if ($vbooking->user_id==auth()->user()->id || auth()->user()->hasAnyRole(['Admin']) ||
            auth()->user()->hasAnyRole(['General Manager']))
            <tr>
                <td>{{ $vbooking->bookingnum }}</td>
                <td>
                    {{ $vbooking->visitorname }}
                    &nbsp;
                    @if ((date('Y-m-d')==$vbooking->visitingdate) && (date('H:i')==$vbooking->visitingtime))
                        <span class="fa fa-music">
                            <audio autoplay src="{{ asset('ring_tones/fantasy_alarm_clock.mp3') }}"></audio>
                        </span>
                    @endif
                </td>
                <td>{{ $vbooking->visitingdate }}</td>
                <td>{{ $vbooking->visitingtime }}</td>
                <td>{{ $vbooking->purpose }}</td>
                <td>
                    @if ((date('Y-m-d')==$vbooking->visitingdate) && (date('H:i')==$vbooking->visitingtime))
                        <span class="badge badge-pill badge-primary" style="background-color: green; color:seashell">Welcome
                        Visitor</span>
                    @elseif((date('Y-m-d')<$vbooking->visitingdate && (date('H:i')<$vbooking->visitingtime)) || (date('Y-m-d')==$vbooking->visitingdate && (date('H:i')<$vbooking->visitingtime)))
                        <span class="badge badge-pill badge-primary"
                        style="background-color: rgb(42, 111, 156); color:seashell">Expecting</span>
                    @elseif((date('Y-m-d')>$vbooking->visitingdate))
                        <span class="badge badge-pill badge-primary"
                        style="background-color: crimson; color:seashell">Visited</span>
                    @endif
                </td>
                <td>{{ $vbooking->user->firstname.' '.$vbooking->user->lastname }}</td>
                <td>
                    <span class="fa fa-ellipsis-h"></span>
                </td>
            </tr>
            @endif
            @endforeach


        </tbody>

    </table>

    <p>
        {{ $visitorbookings->links() }}

    </p>
    {{-- @else
        <p style="background-color:crimson; color:whitesmoke; padding:15px; border-radius: 5px;">
            No Visitor has been booked!
        </p>
    @endif --}}


</div>