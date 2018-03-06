<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>


  <title>@yield('title')</title>
  <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="#">
      <meta name="keywords" content="Elomark , Camapign, Report">
      <meta name="author" content="Elomark">
      <!-- Favicon icon -->
      <link rel="icon" href="backend/assets/images/favicon.ico" type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
      <!-- Required Fremwork -->
      {{HTML::style('backend/bower_components/bootstrap/css/bootstrap.min.css')}}
      <!-- themify-icons line icon -->
      {{HTML::style('backend/assets/icon/themify-icons/themify-icons.css')}}
      <!-- ico font -->
      {{HTML::style('backend/assets/icon/icofont/css/icofont.css')}}
{{HTML::style('backend/assets/css/style.css')}}
{{HTML::style('backend/assets/css/jquery.mCustomScrollbar.css')}}

<!-- Datepicker.css -->
{{HTML::style('backend/assets/pages/advance-elements/css/bootstrap-datetimepicker.css')}}
<!-- Data Table Css -->
{{HTML::style('backend/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}
{{HTML::style('backend/assets/pages/data-table/css/buttons.dataTables.min.css')}}
{{HTML::style('backend/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}

<!-- jpro forms css -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" rel="stylesheet" />
{{HTML::style('backend/assets/pages/j-pro/css/demo.css')}}
{{HTML::style('backend/assets/pages/j-pro/css/font-awesome.min.css')}}
{{HTML::style('backend/assets/pages/j-pro/css/j-forms.css')}}
@if (Request::is('login') || Request::is('password/reset/*') || Request::is('password/reset')) 
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endif
<!-- Required Jquery -->
{{HTML::script('backend/bower_components/jquery/js/jquery.min.js')}}
{{HTML::script('backend/bower_components/jquery-ui/js/jquery-ui.min.js')}}
{{HTML::script('backend/bower_components/popper.js/js/popper.min.js')}}
{{HTML::script('backend/bower_components/bootstrap/js/bootstrap.min.js')}}

</head>

<body>
  <!-- Pre-loader start -->
  <div class="theme-loader">
    <div class="ball-scale">
      <div class='contain'>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pre-loader end -->
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">


      <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
              <div class="pcoded-inner-content">
                <div class="main-body">
                  <div class="page-wrapper">

                    <div class="page-body">
                      <div class="card">
                       <div class="row m-t-30 m-b-30 p-l-30 p-r-30">
                        <div class="col-md-4 col-xl-4 col-sm-12">
                          <a href="{{url('dashboard')}}">
                           <img class="img-fluid" src="{{url(asset('backend/assets/images/logo.png'))}}" alt="Theme-Logo"></a>
                         </div>
                         @if(Illuminate\Support\Facades\Auth::check())


                         <?php

                         if (Auth::user()->isClient() || Auth::user()->isClientAdministrator()){
                           $user = Auth::user()->id;
                 

                           if(!empty(App\User::find($user)->getAccounts->first())){
                             $client_logo = App\User::find($user)->getAccounts->first()->client_logo;


                                  }
                                  else{
                                    $client_logo = NULL;
                                  }

                          
                         }
                         elseif(Auth::user()->isAdministrator() || Auth::user()->isCampaignManager()){

                           if (\Request::is('account/*/view') || (\Request::is('account/*/edit')))   {
                            $account = Request::segment(2);
                            $client_logo = App\Account::find($account)->client_logo;
                          }
                          elseif(\Request::is('user/*/view') || \Request::is('user/*/edit') || \Request::is('user/*/mydetail')) {

                            $user_id = Request::segment(2);
                            $is_client = App\User::find($user_id)->client;
                            if($is_client == 'n'){
                              $client_logo = NULL;
                            }else{
                              $client_logo =  App\User::find($user_id)->getAccounts->first()->client_logo;
                            }
                          }        
                          else{
                           $client_logo = NULL;
                         }
                       }
                       else{
                         $client_logo = NULL;
                       }
                       ?>
                       <div class="col-md-4 col-xl-4 col-sm-12">
                        <div class="text-center">
                          <a href="{{url('dashboard')}}"><i style="font-size:58px;" class="fa fa-home m-b-10"></i></a>
                          <h5 class="f-w-900">@yield('sub_title')</h5>
                        </div>

                      </div>

                      @if(!empty($client_logo))

                      <div class="col-md-4 col-xl-4 col-sm-12 text-right">
                        <img  height="150" width="150" class="img-fluid" src="{{url(asset('uploads/client_logo/' . $client_logo))}}" alt="Client-Logo">
                      </div>
                      @endif
               @endif


             </div>




