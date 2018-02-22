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
@section('sub_title' , 'Update Campaign')
@section('content')

<style type="text/css">
  .input-group-addon{
    background: none !important;
    width: 135px;
  }


.select2-container--default .select2-selection--multiple .select2-selection__choice{
   background: white;
   color: #919aa3;
   font-size: 14px;
   padding: 10px 10px;
   width: 235px;
/*   font-weight: 400;
*/}

.select2-container--default .select2-selection--multiple .select2-selection__choice span{
   color: #919aa3;
}




</style>




            <div class="row">
              <div class="col-md-12 col-xl-12 col-sm-12">
                <div class="row m-30">
                <div class="col-sm-12 col-md-6 col-xl-4">
        <div class="">
          
 {!! Form::model($campaign , ['method' => 'PATCH' , 'enctype' => 'multipart/form-data' , 'action' => ['CampaignController@update',$campaign->id]]) !!}
    {!! csrf_field() !!}


    <input type="hidden" id="primary_contact_refer" name="primary_contact_refer" value="{{$campaign->primary_contact}}">

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Account Name: </span>
                </span>
                 <select id="account_id" name="account_id" class="form-control">


                              @foreach($get_accounts as $account)
                              <option {{($campaign->account_id == $account->id? 'selected':'')}} value="{{$account->id}}">{{$account->name}}</option>
                              @endforeach
                          </select>
            </div>


    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Campaign No: </span>
                </span>
            
                 {{Form::text('campaign_no' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'campaign_no' , 
                'name' => 'campaign_no' ))
            }}
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Campaign: </span>
                </span>
             
                    
                 {{Form::text('campaign' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'campaign' , 
                'name' => 'campaign' ))
            }}                                                
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Performance<br>Dashboard </span>
                </span>
             
                        {{Form::textarea('performance_dashboard' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'performance_dashboard' , 
                'name' => 'performance_dashboard' ))
            }}  
                                                                    
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Insight<br>Dashboard </span>
                </span>
                             {{Form::textarea('insight_dashboard' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'insight_dashboard' , 
                'name' => 'insight_dashboard' ))
            }} 
                                                                    
            </div>
                 <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Internal<br>Dashboard </span>
                </span>
                                {{Form::textarea('internal_dashboard' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'internal_dashboard' , 
                'name' => 'internal_dashboard' ))
            }} 
                                                                    
            </div>

   
                                                    </div>
                                  
                                            </div>
<div class="col-sm-12 col-md-6 col-xl-4">
        <div class="">


         <div class="input-group m-t-30">
                <span class="input-group-addon">
                    <span class="text-muted">Sales<br>Developer</span>
                </span>
             <select name="sales_developer[]" class="form-control select2" multiple="multiple" >
             @foreach($sales_developers as $sales_developer)
                              <option value="{{$sales_developer->id}}">{{$sales_developer->firstname}} {{$sales_developer->surname}}</option>
                              @endforeach
        </select>
            
            </div>
@if($campaign->sales_developer_1)
            <input type="hidden" id="sales_developer_1" value="{{$campaign->sales_developer_1}}">
@endif 

@if($campaign->sales_developer_2)
            <input type="hidden" id="sales_developer_2" value="{{$campaign->sales_developer_2}}">
  @endif 
      
      @if($campaign->sales_developer_3)
            <input type="hidden" id="sales_developer_3" value="{{$campaign->sales_developer_3}}">
              @endif 

      @if($campaign->sales_developer_4)
            <input type="hidden" id="sales_developer_4" value="{{$campaign->sales_developer_4}}">
              @endif 

                                                                    

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Start Date: </span>
                </span>
                   <input type="date" class="form-control" name="start_date" id="start_date" value="<?php echo strftime('%Y-%m-%d',
  strtotime($campaign->start_date)); ?>" >
                                                                    
            </div>

    <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">End Date: </span>
                </span>
                  <input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo strftime('%Y-%m-%d',
  strtotime($campaign->end_date)); ?>" >
                                                                    
            </div>
                                          <div class="form-group text-center m-t-50">
                <label class="col-sm-2"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-out btn-success btn-square">Update </button>
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
                    <option {{($campaign->status == 'live'? 'selected':'')}} value="live">Live</option>
                    <option {{($campaign->status == 'completed'? 'selected':'')}} value="completed">Completed</option>
                    <option {{($campaign->status == 'not_started'? 'selected':'')}} value="not_started">Not Started</option>
                    <option {{($campaign->status == 'paused'? 'selected':'')}} value="paused">Paused</option>
                </select>
                    
            </div>

     <div class="input-group">
                <span class="input-group-addon">
                    <span class="text-muted">Primary<br>Contact: </span>
                </span>
              <select name="primary_contact"  id = "primary_contact" class="form-control">
                  
                </select> 
                                                                    
            </div>


{{--             Briefing Document:   --}} 
             
<div class="input-group">

                @if($campaign->briefing_document)
                <span class="input-group-addon">
                    <span class="text-muted">Briefing<br>Document: <hr> <a class="text-underline" href="{{url(asset('uploads/briefing_document/' . $campaign->briefing_document))}}" download="{{$campaign->briefing_document}}">Download</a> </span>
                </span>
               
                  {{Form::text('briefing_document' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'briefing_document' , 
                'name' => 'briefing_document' , 'readonly'))
            }}   
            @else
                     <span class="text-muted">Briefing<br>Document:</span>                                                            
 
  @endif
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
</div>             
<div class="input-group">

 @if($campaign->eoc_report)
                <span class="input-group-addon">
                    <span class="text-muted">EoC Report: <hr> <a class="text-underline" href="{{url(asset('uploads/eoc_report/' . $campaign->eoc_report))}}" download="{{$campaign->eoc_report}}">Download</a>  </span>
                </span>
              
            
                        {{Form::text('eoc_report' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'eoc_report' , 
                'name' => 'eoc_report' ,  'readonly' ))
            }}   
                    @else
                     <span class="text-muted">EoC Report</span>                                                            
 
  @endif                                                    
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
                  @if($campaign->data_file)
                <span class="input-group-addon">
                    <span class="text-muted">Data File: <hr> <a class="text-underline" href="{{url(asset('uploads/data_file/' . $campaign->data_file))}}" download="{{$campaign->data_file}}">Download</a></span>
                </span>

                             {{Form::text('data_file' ,null, 
            $attributes = array('class' => 'form-control' ,
                'id' => 'data_file' , 
                'name' => 'data_file' , 'readonly' ))
            }}   
                                @else
                     <span class="text-muted">Data File</span>                                                            
 
  @endif                   
                                                    
            </div>

          
            <div class="row m-b-20">
                <div class="col-xl-6 ">
                     <div class="input-group">
                                                <input type="file" name="data_file" id="data_file" multiple="multiple">
                                                </div>
                </div>
                
            </div>


            
                  
 
          
           
                                                      {{ Form::close()}}
                                                    </div>
                                            
                                  
                                            </div>

                                        </div>


              </div>




</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {




  
     var sales_developer_1 = $("#sales_developer_1").val();
    var sales_developer_2 = $("#sales_developer_2").val();
    var sales_developer_3 = $("#sales_developer_3").val();
    var sales_developer_4 = $("#sales_developer_4").val();
    var optionVal = [sales_developer_1,sales_developer_2 , sales_developer_3,sales_developer_4];

         $('.select2').val(optionVal);


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






  $("select[name='account_id']").change(function(){

      var account_id = $(this).val();

      var primary_contact_refer = $("#primary_contact_refer").val();

      var token = $("input[name='_token']").val();

      $.ajax({

          url: '<?php echo url("campaign/getEditPrimaryContacts"); ?>',

          method: 'POST',

          data: {account_id:account_id, _token:token},

          success: function(data) {

            console.log(data);

            $('#primary_contact').find('option').remove();

      $.each(data, function(index, item)
        {
            $("#primary_contact").append('<option value = "' + item.id + '">' + item.firstname + ' ' +  item.surname + "</option>");


        }); 
        $("#primary_contact").val(primary_contact_refer);
            


           //  $('#hidden_primary_contact').val(data.firstname + ' '+ data.surname);
           // $('#primary_contact').val(data.firstname + ' '+ data.surname);

          }

      });

  }).change();

    $("select[name='primary_contact']").change(function(){
            $("#user_id").$(this).val();

    }).change();


 


     });

</script>
         

@endsection
