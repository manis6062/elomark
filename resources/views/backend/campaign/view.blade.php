@extends('backend.templates.app')
{{-- PAGE TITLE--}}
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
@section('sub_title' , 'View Campaign')
@section('content')

<style type="text/css">
  .input-group-addon{
    background: none !important;
    width: 150px;
}
</style>



        @if (Auth::user()->isClient() || Auth::user()->isClientAdministrator())


<div class="card-block">
  
 <div class="row text-center m-b-30">
<div class="col-3">
 
            <h6 class="m-b-30 text-capitalize f-w-900">  <span class="text-muted">Client:  </span>
                   {{App\Account::find($campaign->account_id)->name}}</h6>
                   <hr>
                     <h6 class="m-b-30 text-capitalize f-w-900"> <span class="text-muted">Status: </span>
                 {{$campaign->status}} </h6>
                   

               
</div>

@if(!empty($primary_contact))
<div class="col-3">
 
                   <h6 class="m-b-30 text-capitalize f-w-900"> <span class="text-muted">Primary Contact: </span>
                   {{$primary_contact}}</h6>
               
               
</div>
@endif
<div class="col-3">
                      <h6 class="m-b-30 text-capitalize f-w-900">  <span class="text-muted">Campaign Name: </span>
                  {{$campaign->campaign}}</h6>
               
</div>
<div class="col-3">

    <h6 class="m-b-30 f-w-900">  <span class="text-muted">Campaign Number: </span>
                   {{$campaign->campaign_no}}</h6>
 
    
               
</div>

</div>




<div class="row card">

<div class="card-block">
   <div class="dt-responsive table-responsive">

  <table id="" class="table table-striped table-bordered nowrap"> 

 @if($campaign->performance_dashboard_access == 'y' )
   <tr>

    <th>Performance Dashboard:</th>
     <td>{!! $campaign->performance_dashboard !!}"></td>
  </tr>
@endif

 @if($campaign->insight_dashboard_access == 'y' )
  <tr>
    <th>Insight Dashboard:</th>
    <td>{!!$campaign->insight_dashboard !!}}></td>
  </tr>
  @endif
      @if (!Auth::user()->isClientAdministrator() || !Auth::user()->isClient())

    @if($campaign->internal_dashboard_access == 'y' )
 <tr>
    <th>Internal Dashboard:</th>
     <td>{!! $campaign->internal_dashboard !!}}></td>
  </tr>
  @endif
   @endif
  <tr>
    <th class="text-muted text-underline">Campaign Files:</th>
    <td>  @if($campaign->briefing_document)

                   <tr>
                    <th scope="row">Briefing Document</th>
                    <td class=""><a class="text-underline btn btn-success" href="{{url(asset('uploads/briefing_document/' . $campaign->briefing_document))}}" download="{{$campaign->briefing_document}}"> Download</a></td>
                </tr>
                @endif

                 @if($campaign->eoc_report)
   
                 <tr>
                    <th scope="row">Eoc Report</th>
                    <td class=""><a class="btn btn-success text-underline" href="{{url(asset('uploads/eoc_report/' . $campaign->eoc_report))}}" download="{{$campaign->eoc_report}}">Download</a></td>
                </tr>
@endif

                 @if($campaign->data_file)

                 <tr>
                    <th scope="row">Data File</th>
                    <td class=""><a class="btn btn-success text-underline" href="{{url(asset('uploads/data_file/' . $campaign->data_file))}}" download="{{$campaign->data_file}}">Download</a></td>
                </tr>

                @endif</td>
  </tr>
</table>
                                                </div>
</div>
</div>

</div>
@else

<div class="row">
<div class="col-xl-12">
      <div class="col-md-12 col-xl-12 col-sm-12">
          <div class="">


                       {!! Form::model($campaign) !!}
                       {!! csrf_field() !!}

            <div class="row m-30">
                <div class="col-sm-12 col-xl-6">
                    <div class="card-block text-center"> 





                  

          <div class="table-responsive">

 <table class="table m-0">
            <tbody>
                <tr>
                    <th scope="row">Account Name</th>
                    <td class="text-capitalize">{{$campaign->account->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Campaign</th>
                 <td class="text-capitalize">{{$campaign->campaign}}</td>
                </tr>
                <tr>
                    <th scope="row">Campaign No.</th>
               <td class="text-capitalize">{{$campaign->campaign_no}}</td>
                </tr>
  @if($campaign->salesDeveloper1)

                 <tr>
                    <th scope="row">Sales Developer 1</th>
              <td class="text-capitalize">{{$campaign->salesDeveloper1->firstname . ' '}}{{$campaign->salesDeveloper1->surname}}</td>
                </tr>
                @endif

                  @if($campaign->salesDeveloper2)

                 <tr>
                    <th scope="row">Sales Developer 2</th>
              <td class="text-capitalize">{{$campaign->salesDeveloper2->firstname . ' '}} {{$campaign->salesDeveloper2->surname}}</td>
                </tr>
                 @endif


                  @if($campaign->salesDeveloper3)

                 <tr>
                    <th scope="row">Sales Developer 3</th>
              <td class="text-capitalize">{{$campaign->salesDeveloper3->firstname . ' '}}{{$campaign->salesDeveloper3->surname}}</td>
                </tr>
                 @endif


                  @if($campaign->salesDeveloper4)

                 <tr>
                    <th scope="row">Sales Developer 4</th>
              <td class="text-capitalize">{{$campaign->salesDeveloper4->firstname . ' '}}{{$campaign->salesDeveloper4->surname}}</td>
                </tr>
                 @endif

            
            </tbody>
                                            </table>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-sm-12 col-xl-6">
                                        <div class="card-block">
  <div class="table-responsive">

 <table class="table m-0">


            <tbody>


                 <tr>
                    <th scope="row">Start Date</th>
                  <td class="text-capitalize">{{Carbon\Carbon::parse($campaign->start_date)->format('m-d-Y')}}</td>
                </tr>

                  <tr>
                    <th scope="row">End Date</th>
                  <td class="text-capitalize">{{Carbon\Carbon::parse($campaign->end_date)->format('m-d-Y')}}</td>
                </tr>

                 <tr>
                    <th scope="row">Primary Contact</th>
                   <td class="text-capitalize">{{$primary_contact}}</td>
                </tr>
                 <tr>
                    <th scope="row">Status</th>
                  <td class="text-capitalize">{{$campaign->status}}</td>
                </tr>

               @if($campaign->briefing_document)

                   <tr>
                    <th scope="row">Briefing Document</th>
                    <td class=""><a class="text-underline btn btn-success" href="{{url(asset('uploads/briefing_document/' . $campaign->briefing_document))}}" download="{{$campaign->briefing_document}}"> Download</a></td>
                </tr>
                @endif

                 @if($campaign->eoc_report)
   
                 <tr>
                    <th scope="row">Eoc Report</th>
                    <td class=""><a class="btn btn-success text-underline" href="{{url(asset('uploads/eoc_report/' . $campaign->eoc_report))}}" download="{{$campaign->eoc_report}}">Download</a></td>
                </tr>
@endif

                 @if($campaign->data_file)

                 <tr>
                    <th scope="row">Data File</th>
                    <td class=""><a class="btn btn-success text-underline" href="{{url(asset('uploads/data_file/' . $campaign->data_file))}}" download="{{$campaign->data_file}}">Download</a></td>
                </tr>

                @endif
            </tbody>
                                            </table>
                                            </div>


                                      

                                              
                                                 

                                               </div>


                                           </div>

                                              
                                       </div>


                                       <div class="row">

   <div class="dt-responsive table-responsive">

  <table id="" class="table table-striped table-bordered nowrap"> 
                                       @if (!Auth::user()->isSalesDeveloper())

   <tr>

    <th>Performance Dashboard:</th>
     <td>{!!$campaign->performance_dashboard!!}</td>
  </tr>
  @endif


  <tr>
    <th>Insight Dashboard:</th>
     <td>{!!$campaign->insight_dashboard!!}</td>
  </tr>
              @if (!Auth::user()->isSalesDeveloper())
                @if (!Auth::user()->isClientAdministrator() || !Auth::user()->isClient())

 <tr>
    <th>Internal Dashboard:</th>
    <td>{!!$campaign->internal_dashboard!!}</td>
  </tr>
    @endif
     @endif
</table>
    </div>
</div>
{{ Form::close()}}

                                   </div>
                               </div>



                           </div>



                       </div>
                       @endif


                       @endsection
