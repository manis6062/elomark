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

{{--SUB PAGE TITLE--}}
@if (Auth::user()->isAdministrator())
@section('sub_title' , 'Elomark Administrator Dashboard')
@elseif (Auth::user()->isSalesDeveloper())
@section('sub_title' , 'Elomark Sales Developer Dashboard')
@elseif (Auth::user()->isCampaignManager())
@section('sub_title' , 'Elomark Campaign Manager Dashboard')
@elseif (Auth::user()->isClientAdministrator())
@section('sub_title' , 'Client Administrator Dashboard')
@elseif (Auth::user()->isClient())
@section('sub_title' , 'Client Dashboard')
@endif


@section('content')


<style type="text/css">
  .my-detail-block{
    margin : 0 auto;
  }


  .client-admin-margin{
    margin-left: 408px;
  }


</style>

            <div class="row">

      <div class="col-xl-4">
              <div class="col-md-12 col-xl-12 col-sm-12">
               @if (Auth::user()->isAdministrator()  || Auth::user()->isCampaignManager() || Auth::user()->isClientAdministrator())
                <div class="card project-task">
                  <div class="card-header z-depth-bottom-0">
                    <div class="text-center text-underline">
                      <h4 class="f-w-900">Client Accounts : Users</h4>
                    </div>
                  </div>
                  <div class="card-block p-b-10">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <tbody>
                        
                          <tr>
                            <td>
                            <a href="{{url('account/show')}}">
                              <div class="task-contain">
                                <h6 class="bg-c-green d-inline-block text-center"><i class="fa fa-user-md"></i></h6>
                                <p class="d-inline-block m-l-20 f-20">Manage Accounts</p>
                              </div>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                            <a href="{{url('user/showClient')}}">
                              <div class="task-contain">
                                <h6 class="bg-c-green d-inline-block text-center"><i class="fa fa-clone"></i></h6>
                       <p class="d-inline-block m-l-20 f-20">Manage Users</p>
                              </div>
                              </a>
                            </td>
                          </tr>
                             @if (!Auth::user()->isClientAdministrator())
                          <tr>
                            <td>
                             <a href="{{url('account/create')}}">
                              <div class="task-contain">
                                <h6 class="bg-c-green d-inline-block text-center"><i class="ti-plus"></i></h6>
                               <p class="d-inline-block m-l-20 f-20">Create Account</p>
                              </div>
                              </a>
                            </td>
                          </tr>
                          @endif
                          <tr>
                            <td>
                             <a href="{{url('user/create_client/y')}}">
                              <div class="task-contain">
                                <h6 class="bg-c-green d-inline-block text-center"><i class="fa fa-user-plus"></i></h6>
                                  <p class="d-inline-block m-l-20 f-20">Create Users</p>
                              </div>
                              </a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                @endif
              </div>
              </div>


<div class="col-xl-8 ">
<div class="row m-r-5">

              <div class="col-xl-6 m-r-0 {{(Auth::user()->isClientAdministrator())?'client-admin-margin' : ''}}" >

                @if (Auth::user()->isClient())
               <div class="card project-task ">
                  <div class="card-header  z-depth-bottom-0 m-b-10">
                    <div class="text-center text-underline">
                         <h4 class="f-w-900">View Campaigns</h4>
                    </div>
                  </div>
                  <div class="card-block p-b-10">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <tbody>
                          <tr>
                            <td>
 <a href="{{ action('CampaignController@mylivestat',"live" ) }}">                              <div class="task-contain">
                                <h6 class="bg-c-green d-inline-block text-center"><i class="fa fa-industry"></i></h6>
                                  <p class="d-inline-block m-l-20 f-20">My Live Campaigns</p>
                              </div>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
 <a href="{{ action('CampaignController@mylivestat',"completed" ) }}">                              <div class="task-contain">
                                <h6 class="bg-c-green d-inline-block text-center"><i class="fa fa-history"></i></h6>
                                 <p class="d-inline-block m-l-20 f-20">My Historic Campaigns</p>
                              </div>
                              </a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
         @endif


            @if (Auth::user()->isAdministrator())

                <div class="card project-task ">
                  <div class="card-header  z-depth-bottom-0 m-b-10">
                    <div class="text-center text-underline">
                         <h4 class="f-w-900">Elomark Users</h4>
                    </div>
                  </div>
                  <div class="card-block p-b-10">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <tbody>
                          <tr>
                            <td>
                           <a href="{{url('user/create')}}">
                              <div class="task-contain">
                                <h6 class="bg-c-green d-inline-block text-center"><i class="fa fa-user-plus"></i></h6>
                                  <p class="d-inline-block m-l-20 f-20">Create Elomark User</p>
                              </div>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                            <a href="{{url('user/show')}}">
                              <div class="task-contain">
                                <h6 class="bg-c-green d-inline-block text-center"><i class="fa fa-users"></i></h6>
                                 <p class="d-inline-block m-l-20 f-20">Manage Elomark User</p>
                              </div>
                              </a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                @endif        


              
              @if (!Auth::user()->isAdministrator() && (!Auth::user()->isCampaignManager()) && (!Auth::user()->isClient()))
                <div class="card project-task ">
                  <div class="card-header  z-depth-bottom-0 m-b-10">
                    <div class="text-center text-underline">
                         <h4 class="f-w-900">View Campaigns</h4>
                    </div>
                  </div>
                  <div class="card-block p-b-10">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <tbody>
                         @if (Auth::user()->isSalesDeveloper())
                          <tr>
                            <td>
                           <a href="{{url('campaign/mylive')}}">
                              <div class="task-contain">
                                <h6 class="bg-c-green d-inline-block text-center"><i class="fa fa-user-plus"></i></h6>
                                  <p class="d-inline-block m-l-20 f-20">View My Live Campaigns</p>
                              </div>
                              </a>
                            </td>
                          </tr>
                    
                          @endif


                           @if (Auth::user()->isClientAdministrator())
                          <tr>
                            <td>
                           <a href="{{ action('CampaignController@mylivestat',"live" ) }}">
                              <div class="task-contain">
                                <h6 class="bg-c-green d-inline-block text-center"><i class="fa fa-user-plus"></i></h6>
                                  <p class="d-inline-block m-l-20 f-20">Live Campaigns</p>
                              </div>
                              </a>
                            </td>
                          </tr>
                           <tr>
                            <td>
                           <a href="{{ action('CampaignController@mylivestat',"completed" ) }}">
                              <div class="task-contain">
                                <h6 class="bg-c-green d-inline-block text-center"><i class="fa fa-user-plus"></i></h6>
                                  <p class="d-inline-block m-l-20 f-20">Completed Campaigns</p>
                              </div>
                              </a>
                            </td>
                          </tr>
                          @endif
                      



                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                @endif

              </div>



                           @if (!Auth::user()->isClientAdministrator())

              <div class="col-xl-6">
  @if (Auth::user()->isAdministrator()  || Auth::user()->isCampaignManager())
               <div class="card project-task">
                  <div class="card-header  z-depth-bottom-0 m-b-10">
                  <div class="text-center text-underline">
                       <h4 class="f-w-900">Create: Manage Campaigns</h4>
                  </div>
                </div>
                  <div class="card-block p-b-10">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <tbody>
                        <tr>
                          <td>
                          <a href="{{url('campaign/create')}}">
                            <div class="task-contain">
                              <h6 class="bg-c-green d-inline-block text-center"><i class="fa fa-plus-square"></i></h6>
                               <p class="d-inline-block m-l-20 f-20">Create Campaign</p>
                            </div>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                          <a href="{{url('campaign/show')}}">
                            <div class="task-contain">
                              <h6 class="bg-c-green d-inline-block text-center"><i class="fa fa-tasks"></i></h6>
                                <p class="d-inline-block m-l-20 f-20">Manage Campaign</p>
                            </div>
                              </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              @endif
            </div>
              @endif
            </div>
          

  <div class="col-xl-6{{(Auth::user()->isSalesDeveloper())?'':' f-right'}}">

               <div class="project-task ">
                <div class="card-block p-b-10">
                  <div class="table-responsive z-depth-0">
                    <table class="table my-detail-block table-hover">
                      <tbody>
                        <tr>
                          <td>
                     <?php
                            $userId = Auth::id();
?>                           <a href="{{url('user/' . $userId . '/mydetail')}}">
                            <div class="task-contain">
                              <h6 class="bg-c-green d-inline-block text-center"><i class="icofont icofont icofont-ui-file bg-c-green"></i></h6>
                                <p class="d-inline-block m-l-20 f-20">Manage My Details</p>
                            </div>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            </div>




          </div>


@endsection
