@php
$disabled=$errors->any()||empty($this->visitorname)||empty($this->visitingdate)||empty($this->visitingtime)||empty($this->purpose)?true:false;
@endphp
<div>

    @include('admin.messages.success')

    <form wire:submit.prevent='storebookedvisitor'>

        <div class="form-group">
            <label for="">Visitor Name <span style="color: red">*</span> </label>
            <input id="visitorname" type="text" wire:model.debounce.300ms="visitorname" class="form-control"
                placeholder="Visitor Name" required autofocus>
            <div style="color:crimson">
                @error('visitorname')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Visiting Date <span style="color: red">*</span></label>
                    <input id="visitingdate" type="date" wire:model.debounce.300ms="visitingdate" class="form-control"
                        placeholder="Visiting Date" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Visiting Time <span style="color: red">*</span></label>
                    <input id="visitingtime" type="time" wire:model.debounce.300ms="visitingtime" class="form-control"
                        placeholder="Visiting Time" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="">Purpose <span style="color: red">*</span></label>
            <select id="purpose" wire:model.debounce.300ms="purpose" class="form-control" required>
                <option value="" selected="disabled">Select Visiting Purpose</option>
                <option value="Business">Business</option>
                <option value="Job">Job</option>
                <option value="Official">Official</option>
                <option value="Personal">Personal</option>
            </select>
        </div>

        <p>
            <a href="{{ route('visitorbookings.index') }}" class="btn btn-danger btn-sm">Cancel</a>
            <button type="submit" class="btn btn-success btn-sm" wire:target='storebookedvisitor'
                wire:loading.attr='disabled' :disabled="$disabled" @if($disabled) disabled @endif>Submit
                Booking</button>
        </p>
    </form>
</div>