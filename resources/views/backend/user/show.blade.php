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
@if($is_client && $is_client == 'y')
@section('sub_title' , 'Manage User')
@else
@section('sub_title' , 'Manage Elomark User')
@endif
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

/*  .new-form-class{
    width: 100%;
  }*/




</style>





<div class="row">
 <div class="col-md-12 col-xl-12">
  <div class="card-block">
       @if($is_client && $is_client == 'y')

 {{ Form::open(['action' => 'UserController@searchClients', 'method' => 'POST' , 'class' => 'new-form-class']) }}
 @else
  {{ Form::open(['action' => 'UserController@search', 'method' => 'POST']) }}
  @endif

 <div class="row">
    
      <div class="col-md-6 col-xl-6">
        <div class="input-group">
          <span class="input-group-addon">
            <span class="text-muted">Search : </span>
          </span>
          <input type="text" class="form-control" name="keyword" id="keyword" placeholder="" required="required">

        </div>

      </div>

      <div class="col-md-6 col-xl-6">
       <div class="input-group"><div class="col-sm-10">

        <button type="submit" class="btn btn-out btn-success btn-square">Search</button>
      </div>
    </div>
  </div>
</div>

  {{Form::close()}}



<div class="dt-responsive table-responsive">
  <table id="users" class="table table-striped table-bordered nowrap">
    <thead>
      <tr>
       <th>User</th>
       @if($is_client && $is_client == 'y')
       <th>Account</th>
       @endif
       <th>View</th>
       <th>Edit</th>
       <th>Delete</th>
       <th>Status</th>

     </tr>
   </thead>
   <tbody>                    

    @foreach($getall_users as $value)
    <tr class="text-center">
      <td class="text-left">{{$value->firstname}} {{$value->surname}}</td>
             @if($is_client && $is_client == 'y')

       <td> @foreach($value->getAccounts as $account)
                        {{$account->name}}
                        @endforeach</td>
                        @endif
      <td class="text-underline"><a href= "{{url('user') . '/' . $value->id . '/view' }}">View User</a></td>
      <td class="text-underline"><a href= "{{url('user') . '/' . $value->id . '/edit' }}">Edit User</a></td>



        <td> <a class="text-underline delete-user" href="{{route('user.destroy', $value->id)}}">Delete User</a></td>

      <td class="text-capitalize"><span class="status">{{$value->status}}</span></td>
    </tr>
    @endforeach
  </tbody>     
</table>
</div>

</div>

</div>

</div>

<script type="text/javascript">
    $(".delete-user").on("click", function(){
        return confirm("Do you want to delete this user?");
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


