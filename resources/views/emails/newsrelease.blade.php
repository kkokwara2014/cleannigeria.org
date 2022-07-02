@component('mail::message')

<div style="text-align: center">
    <img src="http://cleannigeria.org/bootstrap_assets/images/LOGO.png" width="90" height="90">
</div>


<h1><strong>{{ $title }}</strong></h1>
<div>
    <img src="http://cleannigeria.org/user_images/{{$userimage}}" class="img-responsive img-rounded"
        width="50" height="50" style="border-radius: 50%" align="left" /> &nbsp;
    Published {{ $updated_at->diffForHumans() }} on
    {{ date('D j M, Y',strtotime($updated_at)) }}
    <p>&nbsp; by <strong>{{ $firstname.' '.$lastname }}</strong></p>

</div>

<div>
    <img src="http://cleannigeria.org/news_images/{{$image}}" class="img-responsive img-rounded" style="border-radius: 10px;">
</div>

<p style="text-align: justify">
    {{ $body }}

    <p>
        <strong>{{ $firstname.' '.$lastname }}</strong>
        <blockquote>
            <small><i>Editor-in-Chief</i></small>
        </blockquote>
    </p>
</p>



<p>
    @if ($filename!='')
    <a href="{{route('download.news', $filename )}}" download="{{ $filename }}">
        <span class="fa fa-file-pdf-o fa-3x" style="color: red"></span>
    </a>
    @endif
</p>




Thanks,<br>
{{ config('app.name') }}
@endcomponent