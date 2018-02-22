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
@section('sub_title' , 'View Account')
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
                    <div class="card-block text-center"> 



                       {!! Form::model($account) !!}
                       {!! csrf_field() !!}

          <div class="table-responsive">

 <table class="table m-0">
            <tbody>
                <tr>
                    <th scope="row">Account Name</th>
                    <td class="text-capitalize">{{$account->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Account No.</th>
                 <td class="text-capitalize">{{$account->account_no}}</td>
                </tr>
                <tr>
                    <th scope="row">Phone</th>
               <td class="text-capitalize">{{$account->phone}}</td>
                </tr>

                 <tr>
                    <th scope="row">Email Domain</th>
              <td>{{$account->email_domain}}</td>
                </tr>
@if($account->secondary_domain)
                 <tr>
                    <th scope="row">Secondary Domain</th>
                  <td>{{$account->secondary_domain}}</td>
                </tr>
                @endif
@if($primary_contact)
                 <tr>
                    <th scope="row">Primary Contact</th>
                   <td class="text-capitalize">{{$primary_contact}}</td>
                </tr>
                  @endif

                 <tr>
                    <th scope="row">Status</th>
                  <td class="text-capitalize">{{$account->status}}</td>
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
            @if($account->address_1)
             <tr>
                    <th scope="row">Address 1</th>
                    <td class="text-capitalize">{{$account->address_1}}</td>
                </tr>
                @endif
                            @if($account->address_2)

                 <tr>
                    <th scope="row">Address 2</th>
                    <td class="text-capitalize">{{$account->address_2}}</td>
                </tr>
                                @endif
  @if($account->address_3)
                 <tr>
                    <th scope="row">Address 3</th>
                    <td class="text-capitalize">{{$account->address_3}}</td>
                </tr>
                 @endif
                <tr>
                    <th scope="row">City</th>
                    <td class="text-capitalize">{{$account->name}}</td>
                </tr>
                <tr>
                    <th scope="row">County</th>
                    <td>{{$account->country_1}}</td>
                </tr>
                <tr>
                    <th scope="row">Country</th>
                    <td>{{$account->country_2}}</td>
                </tr>
                <tr>
                    <th scope="row">Post Code</th>
                    <td class="text-capitalize">{{$account->post_code}}</td>
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
