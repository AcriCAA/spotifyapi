
<aside id="sidebar" class="sidebar d-flex flex-column flex-shrink-0 p-3 border-end border-primary">

  <ul class="nav nav-pills flex-column mb-auto">


   
    
    @auth

    @if (Auth::user()->hasRole('superadmin|facilitator|student'))
    <li class="nav-item">
      <a href="{{route('dashboard')}}" class="nav-link">
        <i class="fa-solid fa-fw fa-house me-2 nav-link-icon"></i>
        <span class="nav-link-text">Dashboard</span>
      </a>
    </li>
   {{--  @elseif(Auth::user()->hasRole('facilitator|student'))
    <li class="nav-item">
      <a href="{{route('all_vans')}}" class="nav-link">
        <i class="fa-solid fa-fw fa-house me-2 nav-link-icon"></i>
        <span class="nav-link-text">Dashboard</span>
      </a>
    </li> --}}
    @endif

    @if (Auth::user()->hasRole('superadmin|facilitator'))
    <li class="nav-item">
      <a href="/vans/all" class="nav-link" >
       
        <i class="fa-solid fa-fw  fa-school me-2 nav-link-icon"></i>
        <span class="nav-link-text">All VANs</span>
      </a>
    </li>

       <li class="nav-item">
      <a href="{{route('show_all_jobs')}}" class="nav-link" >
       
        <i class="fa-solid fa-fw  fa-briefcase me-2 nav-link-icon"></i>
        <span class="nav-link-text">Jobs</span>
      </a>
    </li>


  
    <li class="nav-item">
      <a href="{{route('credit_transaction_form')}}" class="nav-link" >
       
        <i class="fa-solid fa-fw  fa-dollar me-2 nav-link-icon"></i>
        <span class="nav-link-text">Credit an Account</span>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{route('debit_transaction_form')}}" class="nav-link" >
       
        <i class="fa-solid fa-fw  fa-minus me-2 nav-link-icon"></i>
        <span class="nav-link-text">Debit an Account</span>
      </a>
    </li>

 

    @endif



    @if (Auth::user()->hasRole('superadmin'))
    <li class="nav-item">
      <a href="/users/all" class="nav-link">
        <i class="fa-solid fa-fw  fa-user-group me-2 nav-link-icon"></i>
        <span class="nav-link-text">Users</span>
      </a>
    </li>
    @endif




    @if (Auth::user()->hasRole('facilitator|superadmin'))
    <li class="nav-item">
      <a href="/students/all" class="nav-link">
        <i class="fa-solid fa-fw  fa-graduation-cap me-2 nav-link-icon"></i>
        <span class="nav-link-text">Students</span>
      </a>
    </li>
    <ul style="list-style-type: none;">
    <li class="nav-item">
      <a href="{{route('new_student')}}" class="nav-link">
        <i class="fa-solid fa-fw  fa-plus me-2 nav-link-icon"></i>
        <span class="nav-link-text">Add Student</span>
      </a>
    </li>
  </ul>
    
    @endif


    @if (Auth::user()->hasRole('student'))
    <li class="nav-item">
      <a href="/students/profile/{{Auth::user()->id}}" class="nav-link">
        <i class="fa-solid fa-fw  fa-graduation-cap me-2 nav-link-icon"></i>
        <span class="nav-link-text">Me</span>
      </a>
    </li>
@endif

  {{-- This is for students to run payroll --}}
    @if (Auth::user()->isExecutive())
    <li class="nav-item">
      <a href="/vans/payroll/confirm/{{Auth::user()->id}}" class="nav-link">
        <i class="fa-solid fa-fw fa-money-check-dollar nav-link-icon"></i>
        <span class="nav-link-text">Run Payroll</span>
      </a>
    </li>
    @endif

    {{-- This is the route for facilitators or superadmin to run payroll --}}
        @if (Auth::user()->hasRole('facilitator|superadmin'))
    <li class="nav-item">
      <a href="/payroll/admin_select_van/" class="nav-link">
        <i class="fa-solid fa-fw fa-money-check-dollar nav-link-icon"></i>
        <span class="nav-link-text">Run Payroll</span>
      </a>
    </li>
    @endif


  <li class="nav-item">
      <a href="/products/all" class="nav-link" >
       
        <i class="fa-solid fa-fw  fa-gear me-2 nav-link-icon"></i>
        <span class="nav-link-text">All Products</span>
      </a>
    </li>


{{--     
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="fa-solid fa-gear me-2 nav-link-icon"></i>
        <span class="nav-link-text">Settings</span>
      </a>
    </li> --}}
    
    @endauth



    

    
  </ul>
  <ul class="nav nav-pills d-flex">



    <li class="nav-item">
      <a href="#" class="nav-link" data-toggle="sidebar-expand">
        <i class="fa-solid fa-angles-left me-2 nav-link-icon"></i>
        <span class="nav-link-text">Collapse Menu</span>
      </a>
    </li>
  </ul>

  <!-- Right Side Of Navbar -->
  
</aside>