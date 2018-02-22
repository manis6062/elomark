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
@section('sub_title' , 'Create a New Client Account')
@section('content')

<style type="text/css">
  .input-group-addon{
    background: none !important;
    width: 135px;
  }
</style>





            <div class="row">
              <div class="col-md-12 col-xl-12 col-sm-12">
                <div class="row m-30">
                <div class="col-sm-12 col-md-6 col-xl-4">
        <div class="">
            <form id="main" enctype='multipart/form-data' method="post" action="{{url('account/store')}}" novalidate>
               {!! csrf_field() !!}


    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Account Name: </span>
                </span>
                 <input value="{{old('name')}}" type="text" class="form-control" name="name" id="name" autocomplete="off" required="required">
                                                                    
            </div>

       <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Status: </span>
                </span>
                 <select name="status" class="form-control">
                    <option value="live">Live</option>
                    <option value="suspended">Suspended</option>
                </select>
                    
</div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Telephone No: </span>
                </span>
                 <input value="{{old('phone')}}" type="text" class="form-control" name="phone" id="phone" autocomplete="off" required="required">
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Address 1: </span>
                </span>
                 <input value="{{old('address_1')}}" type="text" class="form-control" name="address_1" id="address_1" autocomplete="off" required="required">
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Address 2: </span>
                </span>
                 <input value="{{old('address_2')}}" type="text" class="form-control" name="address_2" id="address_2" autocomplete="off" required="required">
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Address 3: </span>
                </span>
                 <input value="{{old('address_3')}}" type="text" class="form-control" name="address_3" id="address_3" autocomplete="off" required="required">
                                                                    
            </div>   </div>
                                  
                                            </div>
<div class="col-sm-12 col-md-6 col-xl-4">
        <div class="">
    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">City: </span>
                </span>
                 <input value="{{old('city')}}" type="text" class="form-control" name="city" id="city" autocomplete="off" required="required">
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">County: </span>
                </span>
                 <input value="{{old('city')}}" type="text" class="form-control" name="country_1" id="country_1" autocomplete="off" required="required">
                                                                    
            </div>
              <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Country: </span>
                </span>
                 <input value="{{old('country_2')}}" type="text" class="form-control" name="country_2" id="country_2" autocomplete="off" required="required">
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Postcode: </span>
                </span>
                 <input value="{{old('post_code')}}" type="text" class="form-control" name="post_code" id="post_code" autocomplete="off" required="required">
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Email Domain: </span>
                </span>
                 <input value="{{old('email_domain')}}" type="text" class="form-control" name="email_domain" id="email_domain"  autocomplete="off" required="required">
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Secondary<br>Domain: </span>
                </span>
                 <input value="{{old('secondary_domain')}}"  style="height: 38px;" type="text" class="form-control" name="secondary_domain" id="secondary_domain" autocomplete="off" >
                                                                    
            </div></div>
                                  
                                            </div>
                                           <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <div class="">
                                                  
            

  <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Account No: </span>
                </span>
                 <input value="{{old('account_no')}}" type="text" class="form-control" name="account_no" id="account_no" autocomplete="off" required="required">
                                                                    
            </div>

                                                          <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Primary<br>Contact: </span>
                </span>

                <select id= "primary_contact" name="primary_contact" class="form-control">
                              @foreach($getAllUsers as $user)
                              <option value="{{$user->id}}">{{$user->firstname}} {{$user->surname}}</option>
                              @endforeach
                          </select>
      
                    
            </div>
             <div class="card-block text-center ">
  <img  id="thumbnil" style="display: none;" height="150" width="150" class=" z-depth-top-0  img-fluid" src="#" alt="Client-Logo">
  </div>
            <div class="card-block text-center">

                    
                                                <h6 class="text-muted f-w-900">Client Logo</h6>
                                                <p>* Recommended Logo size : 150*150.</p>
<hr>
                 <div class="input-group m-t-5">
           <input type="file" name="file" accept="image/*"  onchange="showMyImage(this)" />
                                                </div>
                </div>

                 <input type="hidden" class="form-control" name="client_logo" id="client_logo" >
                                                                    
            
               {{--                                     <div class="form-group">
                <label class="col-sm-2"></label>
                <div class="col-sm-10">
                    <button class="btn btn-info">Upload Logo</button>
                </div>
            </div> --}}
 
            <div class="form-group text-center">
                <label class="col-sm-2"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-out btn-success btn-square">Create Account</button>
                </div>
            </div>
           
                                                        </form>
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
