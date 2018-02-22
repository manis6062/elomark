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
@section('sub_title' , 'Update Client Account')
@section('content')

<style type="text/css">
  .input-group-addon{
    background: none !important;
    width: 135px;
  }


   .input-height-new{
    height: 38px;
   }
</style>





            <div class="row">
              <div class="col-md-12 col-xl-12 col-sm-12">
                <div class="row m-30">
                <div class="col-sm-12 col-md-6 col-xl-4">
        <div class="">

         {!! Form::model($account , ['method' => 'PATCH' , 'action' => ['AccountController@update',$account->id] , 'enctype' => 'multipart/form-data']) !!}
    {!! csrf_field() !!}

                           @if (!Auth::user()->isClientAdministrator())

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Account Name: </span>
                </span>
                  {{Form::text('name' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'name' , 
                'name' => 'name' ))
            }}
                                                                    
            </div>


       <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Status: </span>
                </span>

                 <select name="status" class="form-control">
                    <option {{($account->status == 'live'?'selected':'')}} value="live">Live</option>
                    <option  {{($account->status == 'suspended'?'selected':'')}} value="suspended">Suspended</option>
                </select>
                    
</div>
   @endif

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Telephone No: </span>
                </span>
                {{Form::text('phone' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'phone' , 
                'name' => 'phone' ))
            }}
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Address 1: </span>
                </span>
     {{Form::text('address_1' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'address_1' , 
                'name' => 'address_1' ))
            }}                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Address 2: </span>
                </span>
                     {{Form::text('address_2' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'address_2' , 
                'name' => 'address_2' ))
            }}                                                 
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Address 3: </span>
                </span>
                     {{Form::text('address_3' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'address_3' , 
                'name' => 'address_3' ))
            }}                                                           
            </div>   </div>
                                  
                                            </div>
<div class="col-sm-12 col-md-6 col-xl-4">
        <div class="">
    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">City: </span>
                </span>
                 {{Form::text('city' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'city' , 
                'name' => 'city' ))
            }}                                                                              
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">County: </span>
                </span>
                       {{Form::text('country_1' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'country_1' , 
                'name' => 'country_1' ))
            }}                                                    
            </div>
              <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Country: </span>
                </span>
                            {{Form::text('country_2' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'country_2' , 
                'name' => 'country_2' ))
            }}                                                  
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Postcode: </span>
                </span>
                                {{Form::text('post_code' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'post_code' , 
                'name' => 'post_code' ))
            }}                                                       
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Email Domain: </span>
                </span>
         
                    {{Form::text('email_domain' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'email_domain' , 
                'name' => 'email_domain' )) }}
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Secondary<br>Domain: </span>
                </span>
               
                   {{Form::text('secondary_domain' ,null, 
            $attributes = array('class' => 'form-control input-height-new' ,
                'id' => 'secondary_domain' , 
                'name' => 'secondary_domain' )) }}
                                                                    
            </div></div>
                                  
                                            </div>
                                           <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <div class="">
                                                  
            
                           @if (!Auth::user()->isClientAdministrator())

  <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Account No: </span>
                </span>
    
                  {{Form::text('account_no' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'account_no' , 
                'name' => 'account_no' )) }}
                                                                    
            </div>

                                                          <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Primary<br>Contact: </span>
                </span>
         <select name="primary_contact" class="form-control">
         @if($selected_user)
           @if($users)
         @foreach($users as $user)
    <option {{($user->id == $selected_user->id)?'selected':''}} value="{{$user->id}}">{{$user->firstname}} {{$user->surname}}</option>
                @endforeach
                @endif


                @else

                 @if($users)
                  <option style="display:none;"></option>
         @foreach($users as $user)
    <option value="{{$user->id}}">{{$user->firstname}} {{$user->surname}}</option>
                @endforeach
                @endif


 @endif

       
                </select>
                    
            </div>

             <div class="card-block text-center ">
  <img  id="thumbnil" style="display: none;" height="150" width="150" class=" z-depth-top-0  img-fluid" src="#" alt="Client-Logo">
  </div>

  <div class="card-block text-center">

                    
                                                <h6 class="text-muted f-w-900">Upload New Logo</h6>
                                                <p>* Recommended Logo size : 150*150.</p>
<hr>
                 <div class="input-group m-t-5">
           <input type="file" name="file" accept="image/*"  onchange="showMyImage(this)" />
                                                </div>
                </div>

                 <input type="hidden" class="form-control" name="client_logo" id="client_logo" value="{{$account->client_logo}}" >


                                                @endif
 
                
 
            <div class="form-group text-center">
                <label class="col-sm-2"></label>
                <div class="col-sm-10">
                            {{Form::submit('Update' , array('class' => 'btn btn-out btn-success btn-square'))}}

                </div>

            </div>
           
{{ Form::close()}}
                                                    </div>

                                            </div>
                                        </div>
              </div>



</div>

<script type="text/javascript">
     function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];

              $("#client_logo").val(file.name);
              $("#thumbnil").css('display' , 'inline');
              

            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);

        }  


    }

</script>



         

@endsection
