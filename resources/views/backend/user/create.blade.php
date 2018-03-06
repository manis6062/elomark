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
@section('sub_title' , 'Create Client User')
@else
@section('sub_title' , 'Create Elomark User')
@endif
@section('content')

<style type="text/css">
  .input-group-addon{
    background: none !important;
    width: 150px;
}
</style>





<div class="row">
    <div class="col-xl-12">

      <div class="col-md-12 col-xl-12 col-sm-12">
          <div class="">
            <div class="row m-30">
                <div class="col-sm-12 col-xl-6">
                    <div class="card-block">
    {{ Form::open(['action' => 'UserController@store', 'method' => 'POST' , 'id' => 'users-form']) }}

   {!! csrf_field() !!}

                            {{--   @if (Auth::user()->isClientAdministrator())
                              <input type="hidden" name="client_parent" value="{{Auth::user()->id}}">
                              @endif --}}

                              @if (Auth::user()->isCampaignManager())
                              <input type="hidden" name="campaign_parent" value="{{Auth::user()->id}}">
                              @endif



                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="text-muted">First Name : </span>
                                </span>
                                <input value="{{old('firstname')}}" autocomplete="off" type="text" class="form-control" name="firstname" id="firstname" required="required">

                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="text-muted">Surname : </span>
                                </span>
                                <input value="{{old('surname')}}" autocomplete="off"  type="text" class="form-control" name="surname" id="surname" required="required">

                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="text-muted">Telephone No. : </span>
                                </span>
                                <input  value="{{old('phone')}}" autocomplete="off" type="text" class="form-control" name="phone" id="phone" required="required">

                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="text-muted">Mobile : </span>
                                </span>
                                <input value="{{old('mobile')}}" autocomplete="off" type="text" class="form-control" name="mobile" id="mobile" required="required">

                            </div>

                            



                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="text-muted">Job Title : </span>
                                </span>
                                <input value="{{old('job_title')}}" autocomplete="off" type="text" class="form-control" name="job_title" id="job_title" required="required">

                            </div>
                       
                    </div>

                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="card-block">
                          <div class="input-group">
                            <span class="input-group-addon">
                                <span class="text-muted">Role : </span>
                            </span>
                            <select name="role_id" class="form-control">
                              @foreach($getall_roles as $role)
                              <option value="{{$role->id}}">{{$role->description}}</option>
                              @endforeach
                          </select>

                      </div>


                      @if($is_client)
                    <input type="hidden" id="is_client" value="{{$is_client}}">

                      @if($is_client == 'y')
                      <div class="input-group">
                        <span class="input-group-addon">
                            <span class="text-muted">Account : </span>
                        </span>
                        <select id="account_id" name="account_id" class="form-control">
                           @foreach($getall_accounts as $account)
                              <option value="{{$account->id}}">{{$account->name}}</option>
                              @endforeach
                        </select>

                        <input type="hidden" name="client" value="y">

                    </div>

                    @endif
                    @endif


                 {{--     <div class="input-group m-t-50">
                                <span class="input-group-addon">
                                    <span class="text-muted">Username : </span>
                                </span>
                                <input type="text" class="form-control" name="username" id="username" >

                            </div> --}}
<div class="input-group">
                                <span class="input-group-addon">
                                    <span class="text-muted">Email : </span>
                                </span>
                                <input  autocomplete="off"  type="text" class="form-control" name="email" id="email" required="required">
                                 @if($is_client)
                      @if($is_client == 'y')
{{--  <span style="color: black; font-size: 13px;" class="text-underline input-group-addon text-muted" id="basic-addon3"> --}}
  <p class="input-group-addon middle-add-on text-muted" style="width: 34px;">@</p> <select name="select_domain" class="text-underline input-group-addon text-muted" style="color: black; font-size: 13px;"  id = "basic-addon3" class="form-control">
 </select>

 @endif
 @endif
        </div>
              <input id="email_domain" type="hidden" name="email_domain">

                              <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="text-muted">Password : </span>
                                </span>
                                <input value="{{old('password')}}" autocomplete="off" type="password" class="form-control" name="password" id="password" required="required">

                            </div>

                    <div class="form-group">
                        <label class="col-sm-2"></label>
                        <div class="col-sm-10">
                            <button class="btn btn-out btn-success btn-square">Create User</button>
                        </div>
                    </div>
                  {{--   <div class="form-group">
                        <label class="col-sm-2"></label>
                        <div class="col-sm-10">
                            <button class="btn btn-out btn-danger btn-square">Edit  Campaign Permissions</button>
                        </div>
                    </div> --}}
               {{ Form::close()}}
            </div>


        </div>
    </div>
</div>
</div>



</div>



</div>

<script type="text/javascript">
$( document ).ready(function() {

$('#users-form').submit(function() {

  if($('#is_client').val() == 'y'){
 $('#email').val($('#email').val() + '@' + $('#email_domain').val());
  }else{
     $('#email').val($('#email').val() + $('#email_domain').val());
  }
        $("#basic-addon3").css('display' , 'none');
        $(".middle-add-on").css('display' , 'none');
         

    return true;
  });



   $("select[name='account_id']").change(function(){

      var account_id = $(this).val();

      var token = $("input[name='_token']").val();

      $.ajax({

          url: '<?php echo url("account/getEmailDomain"); ?>',

          method: 'POST',

          data: {account_id:account_id, _token:token},

          success: function(data) {

            $('#basic-addon3').find('option').remove();

   $.each(data, function(index, item)
        {

            $("#basic-addon3").append('<option value = "' + item + '">' + item +"</option>");

        }); 

        var first_option_val = $("#basic-addon3").find("option:first-child").val();
          $("#email_domain").val(first_option_val);

          }

      });

  }).change();


$("select[name='select_domain']").change(function(){

            var value = $( this ).val();
            $("#email_domain").val(value);

    }).change();





     });


</script>


@endsection
