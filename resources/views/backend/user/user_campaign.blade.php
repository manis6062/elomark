@extends('backend.templates.app')
@if (Auth::user()->isAdministrator())
@section('title' , 'Elomark : Administrator')
@elseif (Auth::user()->isSalesDeveloper())
@section('title' , 'Elomark : Sales Developer')
@elseif (Auth::user()->isCampaignManager())
@section('title' , 'Elomark : Campaign Manager')
@elseif (Auth::user()->isClientAdministrator())
@section('title' , 'Elomark : Client Administrator')
@elseif (Auth::user()->isClient())
@section('title' , 'Elomark : Client')
@endif

@section('sub_title' , 'Campaign Permissions')
@section('content')

<style type="text/css">
  .input-group-addon{
    background: none !important;
    width: 150px;
  }

  .dataTables_filter{
    display: none;
  }

  .dataTables_length{
    display: none;
  }

  .page-item.active .page-link{
    background-color: green;
    border-color: green;
  }




</style>

<div class="card-block">
  <div class="col-form-label">
  @if(Auth::user()->isClientAdministrator())
     <h5 class="text-center f-w-900 text-muted text-capitalize">User : <span class="">{{$user->firstname}} {{$user->surname}}</span> </h5>
     @else

     @if($user->getAccounts->first())
      <h5 class="text-center f-w-900 text-muted">Account : <span class="">{{$user->getAccounts->first()->name}} </span> </h5>
       @endif
      @endif
  </div>
</div>


             
<div class="row">
 <div class="col-md-12 col-xl-12">
  <div class="card-block">
 {{ Form::open(['action' => 'UserController@campaignSearchByStatus', 'method' => 'POST' , 'class' => 'new-form-class']) }} 
    <div class="row">
      <div class="col-md-6 col-xl-6">
        <div class="input-group">
          <span class="input-group-addon">
            <span class="text-muted m-r-20">Campaign Status </span>
          </span>


          <select class="form-control"  name="status1">
            <option value="all">All</option>
            <option {{($status == 'live')?'selected':''}}  value="live">Live</option>
            <option {{($status == 'completed')?'selected':''}} value="completed">Completed</option>
            @if (!Auth::user()->isClientAdministrator())
            <option {{($status == 'not_started')?'selected':''}} value="not_started">Not Started</option>
            <option {{($status == 'paused')?'selected':''}} value="paused">Paused</option>
            @endif
          </select>

          <input type="hidden" name="status" id="status">
                                    <input type="hidden" name="user_id" value="{{$user->id}}
">


        </div>

      </div>


      <div class="col-md-6 col-xl-6">
       <div class="input-group"><div class="col-sm-10">
        <button type="submit" class="btn btn-out btn-success btn-square">Filter</button>


       
      </div>
    </div>
  </div>
</div>
{{Form::close()}}

   
<div class="dt-responsive table-responsive">
  <table id="users" class="table table-striped table-bordered nowrap">
    <thead>
      <tr>
       <th>Campaign No</th>
              <th>Campaign Name</th>
                <th>Account Name</th>
                <th>Performance Dashboard</th>
              <th>Insight Dashboard</th>
                @if (!Auth::user()->isClientAdministrator())
                <th>Internal Dashboard</th>
                @endif
                <th>Save</th>


     </tr>
   </thead>
   <tbody>   

    @foreach($getCampaigns as $value)


{{--     {{dd($value)}}
 --}}  
    <tr class="text-center">
      {{ Form::open(['action' => 'UserController@campaignAccess', 'method' => 'POST']) }} 
      
    <input type="hidden" name="user_id" value="{{$user->id}}">

      <td class="">{{$value->campaign_no}}</td>
        <td class="">{{$value->campaign}}</td>
     <td class="">{{$accounts->find($value->account_id)->name}}</td>

    <td>

   <input name="performance_dashboard_access"  type="checkbox" class="js-success dashboard-access" value="{{($value->performance_dashboard_access == 'y')?'y' :'n'}}" {{($value->performance_dashboard_access == 'y')?'checked' :''}}/>
   </td>

   <td>

   <input name="insight_dashboard_access"  type="checkbox" class="js-success dashboard-access" value="{{($value->insight_dashboard_access == 'y')?'y' :'n'}}" {{($value->insight_dashboard_access == 'y')?'checked' :''}}/>
   </td>

    @if (!Auth::user()->isClientAdministrator())
    <td>

   <input name="internal_dashboard_access"  type="checkbox" class="js-success dashboard-access" value="{{($value->internal_dashboard_access == 'y')?'y' :'n'}}" {{($value->internal_dashboard_access == 'y')?'checked' :''}}/>

    </td>

@endif





        <td>
        <button type="submit" id="{{$value->id}}" class="btn btn-default btn-outline-success"><i class="icofont icofont-check-circled"></i></button></td>
 <input type="hidden" name="campaign_id" value="{{$value->id}}">

  {{Form::close()}}

    </tr>
   
    @endforeach


  </tbody>  
      
</table>
</div>


</div>

</div>

</div>

<script type="text/javascript">
$( document ).ready(function() {



   $("select[name='status1']").change(function(){

      var status = $(this).val();
     $("#status").val(status);
       

  }).change();
     });


</script>


<!-- Main-body end -->
<!-- Warning Section Starts -->
<!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->



@endsection


