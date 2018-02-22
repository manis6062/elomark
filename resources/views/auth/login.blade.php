@extends('backend.templates.app')
@section('title' , 'Elomark : Login')
@section('content')
<div class="container">
    <div class="row">

            <div class="col-xl-10  m-t-50 m-b-50">
              <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6  ">
                                <input id="password" type="password" class="form-control" name="password" required>

                               
                            </div>
                              <div class="form-group text-right">
                                                               
     <button style="width: 142px;" type="submit" class="btn btn-out btn-success btn-square">Login</button>
                                                             
                      
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-6">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>

                            </div>

                        </div>

                     
                    </form>
                   
                  
            </div>

 

            </div>



</div>
 <div class="text-center m-b-50">
   @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                     @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                @endif
                    
                    </div>

          </div>


@endsection

