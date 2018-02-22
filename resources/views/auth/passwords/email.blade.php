@extends('backend.templates.app')
@section('title' , 'Elomark : Forgot Password')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="">
                <div class="panel-body">
               

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Registered E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                              
                            </div>
                        </div>

                       
                  
                </div>

            </div>
        </div>

    </div>
    <div class="card-block m-b-50">
          <div class="form-group text-right" style="margin-left:655px;">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                   Get Password
                                </button>
                            </div>
                        </div>
    </div>
     <div class="text-center m-b-50">
       @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
          @if (session('status'))
          <span class="help-block">
                                        <strong> {{ session('status') }}</strong>
                                    </span>
                    @endif
                        
                    </div>
                      </form>

</div>
@endsection
