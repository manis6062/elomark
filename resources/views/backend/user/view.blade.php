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
@section('sub_title' , 'View User')
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



                       {!! Form::model($user) !!}
                       {!! csrf_field() !!}



          <div class="table-responsive">

 <table class="table m-0">
            <tbody>
                <tr>
                    <th scope="row">Full Name</th>
                    <td class="text-capitalize">{{$user->firstname}} {{$user->surname}}</td>
                </tr>
                <tr>
                    <th scope="row">Telephone</th>
                    <td>{{$user->phone}}</td>
                </tr>
                <tr>
                    <th scope="row">Mobile</th>
                    <td>{{$user->mobile}}</td>
                </tr>
                <tr>
                    <th scope="row">Job Title</th>
                    <td class="text-capitalize">{{$user->job_title}}</td>
                </tr>
                
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
        @if(!empty($my_account))
            <tr>
                    <th scope="row">Account</th>
                    <td>{{$my_account->name}}</td>
                </tr>
        @endif
                <tr>
                    <th scope="row">Email</th>
                    <td>{{$user->email}}</td>
                </tr>

                   <tr>
                    <th scope="row">Password</th>
                    <td>*************</td>
                </tr>
                <tr>
                    <th scope="row">Role</th>
                    <td class="text-capitalize">{{$my_role->description}}</td>
                </tr>
              {{--   <tr>
                    <th scope="row">Username</th>
                    <td>{{$user->username}}</td>
                </tr> --}}
             

                <tr>
                    <th scope="row">Status</th>
                   <td class="text-capitalize">{{$user->status}}</td>
                </tr>
                
            </tbody>
                                            </table>
                                            </div>

                                      

                                              
                                                   {{ Form::close()}}

                                               </div>


                                           </div>
                                       </div>
                                   </div>
                               </div>



                           </div>



                       </div>


                       @endsection
