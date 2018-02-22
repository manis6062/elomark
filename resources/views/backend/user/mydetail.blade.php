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



 {!! Form::model($user , ['method' => 'PATCH' , 'action' => ['UserController@update',$user->id]]) !!}
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
</div>

</div>
<div class="col-sm-12 col-xl-6">
<div class="card-block">

<div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Role : </span>
                </span>

<select name="role_id" class="form-control" disabled="disabled">
    @foreach($getall_roles as $role)
<option {{($role->id == $my_role->id?'selected':'')}} value="{{$role->id}}">{{$role->description}}
    </option>
     @endforeach
                          </select>
            
</div>


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

    {{--   <div class="input-group m-t-50">
                                <span class="input-group-addon">
                                    <span class="text-muted">Username : </span>
                                </span>
                                {{Form::text('username' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'username' , 
                'name' => 'username' ))
            }}

                            </div> --}}



                            <?php 
$email  = $user->email;
$email_domain = strstr($email, '@');

$user_name = strstr($email, '@', true);
                            ?>

                              <div class="input-group m-t-20">
                <span class="input-group-addon">
                    <span class="text-muted">Email : </span>
                </span>
            {{--     {{Form::text('email' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'email' ))
            }}  --}}

            <input type="text" id="email" name="user_name" class="form-control" value="{{$user_name}}" disabled="disabled">   
            <span style="color: black; font-size: 13px;" class="text-underline input-group-addon text-muted" id="basic-addon3"><input type="hidden" name="email_domain" value="{{$email_domain}}"> {{$email_domain}}
 </span>
            
                                                                    
            </div>

            <input type="hidden" name="email" value="{{$user->email}}">



            <div class="input-group m-t-40">
     <span class="input-group-addon">
                    <span class="text-muted">New Password: </span>
                </span>
   <input type="password" class="form-control" id="new_password" name="new_password">

</div>

 <div class="input-group">
     <span class="input-group-addon"  style="width: 35%;">
                    <span class="text-muted">Confirm Password: </span>
                </span>
   <input type="password" class="form-control" id="confirm_password" name="confirm_password">

</div>
<hr>







                        {{--       <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="text-muted">Password : </span>
                                </span>
                                {{Form::text('new_password' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'new_password' , 
                'name' => 'new_password' ))
            }}

                            </div> --}}

                            <input type="hidden" name="mydetail" value="y">
                                                 
<div class="form-group">
    <label class="col-sm-2"></label>
    <div class="col-sm-10">
    <button type="submit" class="btn btn-out btn-success btn-square">Update Details</button>

    </div>
</div>

                                                                    {{ Form::close()}}

                                                    </div>
                                            
                                  
                                            </div>
                                        </div>
              </div>
              </div>



</div>



          </div>

          <script type="text/javascript">
              var new_password = document.getElementById("new_password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(new_password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

new_password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
          </script>
         

@endsection
