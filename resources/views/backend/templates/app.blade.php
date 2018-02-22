@include('backend.templates.header')

{{-- PAGE TITLE--}}
@if(Illuminate\Support\Facades\Auth::check())

@if(Session::has('success'))
 <ul class="help-block text-center">
     <li class="text-muted f-w-900 text-underline text-capitalize">
     {!! Session::get('success') !!}
    </li>
  </ul>
 @endif


 @if ($errors->any())
    <ul class="help-block text-center">
      @foreach ($errors->all() as $error)
      <li class="text-muted f-w-900 text-underline text-capitalize p-10">{!! $error !!}</li>
      @endforeach
    </ul>
         @endif


         @endif

@yield('content')
@include('backend.templates.footer')
