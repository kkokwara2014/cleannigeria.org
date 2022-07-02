@component('mail::message')

Dear {{ $partnername }}, <br>
Your login details to Clean Nigeria Associates (CNA) platform are 
{{ $partneremail }} and {{ $partnerpassword }} as email and password respectively. 
<p></p>
Kindly visit www.cleannigeria.org/inventory/login to login and make equipment maintenance request.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
