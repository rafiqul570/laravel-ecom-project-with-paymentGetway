<!-- ########## START: MAIN PANEL ########## -->
  @include('admin.inc.header');
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
       
           
           @yield('content')
        
    
      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
     @include('admin.inc.footer');
    <!-- ########## END: MAIN PANEL ########## -->