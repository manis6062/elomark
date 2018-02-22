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
@section('sub_title' , 'Create a Campaign')
@section('content')

<style type="text/css">
  .input-group-addon{
    background: none !important;
    width: 135px;
  }



.select2-container--default .select2-selection--multiple .select2-selection__choice{
   background: white;
   color: #573838;
   padding: 10px 8px;
   width: 235px;
   font-weight: 400;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice span{
  color: black;
}
</style>




            <div class="row">
              <div class="col-md-12 col-xl-12 col-sm-12">
                <div class="row m-30">
                <div class="col-sm-12 col-md-6 col-xl-4">
        <div class="">
             <form id="main" enctype='multipart/form-data' method="post" action="{{url('campaign/store')}}" novalidate>
               {!! csrf_field() !!}
    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Account Name: </span>
                </span>
                 <select id= "account_id" name="account_id" class="form-control">
                              @foreach($get_accounts as $account)
                              <option value="{{$account->id}}">{{$account->name}}</option>
                              @endforeach
                          </select>
            </div>

             @if(Auth::user()->isCampaignManager())
            <input type="hidden" name="campaign_user_id" value="{{Auth::user()->id}}">
                              @endif

             @if (Auth::user()->isAdministrator())
            <input type="hidden" name="campaign_user_id" value="{{0}}">
                              @endif

             <input type="hidden" class="form-control" name="user_id" id="user_id" >


    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Campaign No: </span>
                </span>
                 <input value="{{old('campaign_no')}}" autocomplete="off" type="text" class="form-control" name="campaign_no" id="campaign_no" required="required">
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Campaign: </span>
                </span>
                 <input value="{{old('campaign')}}" autocomplete="off" type="text" class="form-control" name="campaign" id="campaign" required="required">
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Performance<br>Dashboard </span>
                </span>
                <textarea autocomplete="off" class="form-control" name="performance_dashboard" id="performance_dashboard">{{old('performance_dashboard')}}</textarea>
                                                                    
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Insight<br>Dashboard </span>
                </span>
                <textarea autocomplete="off" class="form-control" name="insight_dashboard" id="insight_dashboard">{{old('insight_dashboard')}}</textarea>
                                                                    
            </div>
                 <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Internal<br>Dashboard </span>
                </span>
                <textarea  autocomplete="off" class="form-control" name="internal_dashboard" id="internal_dashboard">{{old('internal_dashboard')}}</textarea>
                                                                    
            </div>

   
                                                    </div>
                                  
                                            </div>
<div class="col-sm-12 col-md-6 col-xl-4">
        <div class="">

        <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Start Date: </span>
                </span>
                 <input required="required" value="{{old('start_date')}}" autocomplete="off" type="date" class="form-control" name="start_date" id="start_date" >
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">End Date: </span>
                </span>
                 <input required="required" value="{{old('end_date')}}" autocomplete="off" type="date" class="form-control" name="end_date" id="end_date" >
                                                                    
            </div>

            <hr>

    <div class="input-group m-t-30">
                <span class="input-group-addon">
                    <span class="text-muted">Sales<br>Developer</span>
                </span>
             <select name="sales_developer[]" class="form-control select2" multiple="multiple" required="required">
             @foreach($sales_developers as $sales_developer)
                              <option value="{{$sales_developer->id}}">{{$sales_developer->firstname}} {{$sales_developer->surname}}</option>
                              @endforeach
        </select>
            
            </div>
  
    
                                          <div class="form-group text-center m-t-50">
                <label class="col-sm-2"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-out btn-success btn-square">Create Campaign</button>
                </div>
            </div>
              
                                                    </div>
                                  
                                            </div>
                                           <div class="col-sm-12 col-md-6 col-xl-4">
                                                    <div class="">

                                                          <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Status: </span>
                </span>
 <select name="status" class="form-control">
                    <option value="live">Live</option>
                    <option value="completed">Completed</option>
                    <option value="not_started">Not Started</option>
                    <option value="paused">Paused</option>

                </select>
                    
            </div>

            <div class="input-group" >
                <span class="input-group-addon">
                    <span class="text-muted">Primary<br>Contact: </span>
                </span>
              <select  name="primary_contact"  id = "primary_contact" class="form-control">
                  
                </select> 
{{-- <input type="hidden" class="form-control" name="user_id" id="user_id" value="">
 --}}                                                                    
            </div>
      <hr>

{{--             Briefing Document:   --}} 
              
<div class="input-group">
                <span class="">
                    <span class="text-muted text-underline">Briefing Document: </span>
                </span>
                 <input type="hidden" class="form-control" name="briefing_document" id="briefing_document" >
                                                                    
            </div>

          
            <div class="row m-b-20">
                <div class="col-xl-6 ">
                     <div class="input-group">
                                                <input type="file" name="briefing_document" id="briefing_document">
                                                </div>
                </div>
                 
            </div>
   <hr>

            {{--             EoC Report:   --}}    
                          
<div class="input-group">
                 <span class="">
                    <span class="text-muted  text-underline">EOC Report: </span>
                </span>
                 <input type="hidden" class="form-control" name="eoc_report" id="eoc_report" >
                                                                    
            </div>

          
            <div class="row m-b-20">
                <div class="col-xl-6 ">
                     <div class="input-group">
                                                <input type="file" name="eoc_report" id="eoc_report">
                                                </div>
                </div>
                 
            </div>
            <hr>


            {{--             Data File:   --}}   
                           
<div class="input-group">
                 <span class="">
                    <span class="text-muted  text-underline">Data File: </span>
                </span>
                 <input type="hidden" class="form-control" name="data_file" id="inputDisplayFileName" >
                                                                    
            </div>

          
            <div class="row m-b-20">
                <div class="col-xl-6 ">
                     <div class="input-group">
                                                <input type="file" name="data_file" id="data_file">
                                                </div>
                </div>
                
            </div>


            
                  
 
          
           
                                                        </form>
                                                    </div>
                                            
                                  
                                            </div>

                                        </div>


              </div>




</div>

<script type="text/javascript">
$( document ).ready(function() {


  $("select[name='account_id']").change(function(){

      var account_id = $(this).val();

      var token = $("input[name='_token']").val();

      $.ajax({

          url: '<?php echo url("campaign/getPrimaryContacts"); ?>',

          method: 'POST',

          data: {account_id:account_id, _token:token},

          success: function(data) {

            console.log(data);

            $('#primary_contact').find('option').remove();

      $.each(data, function(index, item)
        {
            $("#primary_contact").append('<option value = "' + item.id + '">' + item.firstname + ' '+ item.surname +"</option>");
        }); 


           //  $('#hidden_primary_contact').val(data.firstname + ' '+ data.surname);
           // $('#primary_contact').val(data.firstname + ' '+ data.surname);

          }

      });

  }).change();

   $("select[name='primary_contact']").change(function(){
            $("#user_id").$(this).val();

    }).change();


  // $("select[name='primary_contact']").change(function(){

  //     var user_id = $(this).val();
  //           $('#user_id').val(user_id);


  // }).change();




     });


</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>


<script>
    $(document).ready(function() {
    $(".select2").select2({
          maximumSelectionLength: 4,
           language: {
        // You can find all of the options in the language files provided in the
        // build. They all must be functions that return the string that should be
        // displayed.
        maximumSelected: function (e) {
            var t = e.maximum + " Sales Developers Max !";
            e.maximum != 1 && (t += " ");
            return t;
        }
    }
    });
});
</script>


         

@endsection
