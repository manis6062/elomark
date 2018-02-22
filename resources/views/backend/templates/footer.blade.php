         @if(Illuminate\Support\Facades\Auth::check())
         <div class="card-block">
                     <h6 class="sub-title p-20"></h6>


          <div class="text-center text-underline">


    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                          <h5> LOGOUT  <i class="ti-layout-sidebar-left"></i> </h5>
                                        </a>
                                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

          </div>
         </div>
         @endif
  


        </div>

      </div>

  </div>


</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Warning Section Starts -->
<!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->

{{-- bower_components --}}


<!-- jquery slimscroll js -->
{{HTML::script('backend/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}
<!-- modernizr js -->
{{HTML::script('backend/bower_components/modernizr/js/modernizr.js')}}
{{HTML::script('backend/bower_components/modernizr/js/css-scrollbars.js')}}

<!-- Datatables js -->
{{HTML::script('backend/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}
{{HTML::script('backend/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}

{{HTML::script('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}
{{HTML::script('backend/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}
{{HTML::script('backend/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
{{-- Datepicker --}}
{{HTML::script('backend/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}
{{HTML::script('backend/assets/pages/advance-elements/bootstrap-datetimepicker.min.js')}}


<!-- Custom js -->
{{HTML::script('backend/assets/pages/dashboard/custom-dashboard.min.js')}}
{{HTML::script('backend/assets/js/SmoothScroll.js')}}
{{HTML::script('backend/assets/js/pcoded.min.js')}}
{{HTML::script('backend/assets/js/menu/menu-sidebar-static.js')}}
{{HTML::script('backend/assets/js/jquery.mCustomScrollbar.concat.min.js')}}
{{HTML::script('backend/assets/js/script.min.js')}}
 {{HTML::script('backend/js/custom.js')}}
 @if (Request::is('login') || Request::is('password/reset/*') || Request::is('password/reset')) 
  <script src="{{ asset('js/app.js') }}"></script>

  @endif
</body>
</body>

</html>














