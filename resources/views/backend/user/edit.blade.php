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
@section('sub_title' , 'Update User')
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



 {!! Form::model($user , ['method' => 'PATCH' , 'id' => 'users-edit-form' , 'action' => ['UserController@update',$user->id]]) !!}
    {!! csrf_field() !!}

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">First Name : </span>
                </span>
                {{Form::text('firstname' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'frst_name' , 
                'name' => 'firstname' ))
            }}
                 
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Surname : </span>
                </span>
                    {{Form::text('surname' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'surname' , 
                'name' => 'surname' ))
            }}
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Telephone No. : </span>
                </span>
                 {{Form::text('phone' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'phone' , 
                'name' => 'phone' ))
            }}
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Mobile : </span>
                </span>
               {{Form::text('mobile' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'mobile' , 
                'name' => 'mobile' ))
            }}                                               
            </div>

  

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Job Title : </span>
                </span>
                {{Form::text('job_title' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'job_title' , 
                'name' => 'job_title' ))
            }}    
                                                                    
</div>


<div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Status: </span>
                </span>

                 <select name="status" class="form-control">
                    <option {{($user->status == 'live'?'selected':'')}} value="live">Live</option>
                    <option  {{($user->status == 'suspended'?'selected':'')}} value="suspended">Suspended</option>
                </select>
                    
</div>

</div>

</div>
<div class="col-sm-12 col-xl-6">
<div class="card-block">

@if(!empty($my_account))
<div class="input-group">
<span class="input-group-addon">
<span class="text-muted">Account : </span>
</span>
           <select name="account_id" class="form-control" disabled="disabled">

@foreach($getall_accounts as $account)
<option {{($account->id == $my_account->id? 'selected':'')}} value="{{$account->id}}">{{$account->name}}
    </option>
     @endforeach
                                </select>
          
</div>
@endif

<div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Role : </span>
                </span>

           <select name="role_id" class="form-control" >
    @foreach($getall_roles as $role)
<option {{($role->id == $my_role->id?'selected':'')}} value="{{$role->id}}">{{$role->description}}
    </option>
     @endforeach
                          </select>
            
</div>

    
{{--     <div class="input-group m-t-50">
                                <span class="input-group-addon">
                                    <span class="text-muted">Username : </span>
                                </span>
                               {{Form::text('username' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'username' , 
                'name' => 'username' ))
            }}    

                            </div> --}}


@if(!empty($my_account))



                                 <?php 


$email  = $user->email;

if(!empty($email)){
            $email_domain = substr(strrchr($email, "@"), 1);
        }

$user_name = strstr($email, '@', true);
                            ?>




                              <div class="input-group m-t-50">
                <span class="input-group-addon">
                    <span class="text-muted">Email : </span>
                </span>
            {{--     {{Form::text('email' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'email' ))
            }}  --}}

            <input type="text" id="email" name="email" class="form-control" value="{{$user_name}}" required="required">   
       {{--      <span style="color: black; font-size: 13px;" class="text-underline input-group-addon text-muted" id="basic-addon3"> --}}
 </span>
<p class="input-group-addon middle-add-on text-muted" style="width: 34px;">@</p>
    <select name="select_domain" class="text-underline input-group-addon text-muted" style="color: black; font-size: 13px;"  id = "basic-addon3" class="form-control">
 </select>

 <input type="hidden" name="email_domain" id="email_domain" value="">


 <input type="hidden" id="seleted_email_domain" value="{{$email_domain}}">
            
                                                                    
            </div>


{{--             <input type="hidden" name="email" value="{{$user_name.'@'.$email_domain}}">
 --}}  @else

                                <?php 
$email  = $user->email;
$email_domain = strstr($email, '@');
$email_domain =str_replace('@' , '' , $email_domain);

$user_name = strstr($email, '@', true);
                            ?>                              <div class="input-group m-t-50">
                <span class="input-group-addon">
                    <span class="text-muted">Email : </span>
                </span>
            {{--     {{Form::text('email' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'email' ))
            }}  --}}

            <input type="text" id="email" name="email" class="form-control" value="{{$user_name}}">   
            <span style="color: black; font-size: 13px;" class="text-underline input-group-addon text-muted" id="basic-addon3"><input type="hidden" name="email_domain" id="email_domain" value="{{$email_domain}}"> {{$email_domain}}
 </span>
            
                                                                    
            </div>


@endif

<hr>

            <div class="row m-t-50">
    <label class="col-sm-4"> <span class="text-muted form-control">Reset Password : </span></label>
    <div class="col-sm-8">
   <input type="checkbox" class="form-control" value="y" name="new_password">
   <div class="text-center">
        <p class="text-muted">* Tick the box for reset password.</p>

   </div>
    </div>
</div>


<hr>

{{-- <input type="checkbox" name="new_password">Reset Password

                              <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="text-muted"> New Password:  </span>
                                </span>
                                                 {{Form::text('new_password' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'new_password' , 
                'name' => 'new_password' ))
            }}   
                            </div> --}}






                                                 
<div class="form-group">
    <label class="col-sm-2"></label>
    <div class="col-sm-10">

        {{Form::submit('Submit' , array('class' => 'btn btn-out btn-success btn-square'))}}
    </div>
</div>
@if(!empty($my_account))
    <div class="form-group">
    <label class="col-sm-2"></label>
    <div class="col-sm-10">
     <a class="btn btn-out btn-danger btn-square" href ="{{url('user/' . $user->id. '/campaign'  )}}">Edit  Campaign Permissions</a>
    </div>
</div>
@endif
@if (Auth::user()->isAdministrator())

@if ($my_role->id == 2)
  <div class="form-group">
    <label class="col-sm-2"></label>
    <div class="col-sm-10">
     <a class="btn btn-out btn-danger btn-square" href ="{{url('user/' . $user->id. '/managerCampaign'  )}}">Edit  Campaign Permissions</a>
    </div>
</div>

  @endif

@endif
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


    $("select[name='select_domain']").change(function(){

            var value = $( this ).val();
            $("#email_domain").val(value);

    }).change();


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

        // var first_option_val = $("#basic-addon3").find("option:first-child").val();
          $("#basic-addon3").val($('#seleted_email_domain').val());
           $("#email_domain").val($('#seleted_email_domain').val());

          }

      });

  }).change();






$('#users-edit-form').submit(function() {
    $('#email').val($('#email').val() +'@'+ $('#email_domain').val());
        $("#basic-addon3").css('display' , 'none');
        $("#email").css('disabled' , 'disabled');
         $(".middle-add-on").css('display' , 'none');
        

    return true;
  });
});


</script>
         

@endsection
