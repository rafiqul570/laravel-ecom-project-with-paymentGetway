<!-- ########## START: MAIN PANEL ########## -->
  @include('admin.inc.header');
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
           
           @yield('content')
        
        </div><!-- sl-page-title -->
      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
     @include('admin.inc.footer');
    <!-- ########## END: MAIN PANEL ########## -->