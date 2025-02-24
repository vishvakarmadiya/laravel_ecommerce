  <div class="top-header">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-md-3">
                  <div class="logo">
                      <a href="{{ route('index') }}">
                          <img src="{{ asset('fontend/img/logo.png')}}" alt="Logo">
                      </a>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="search">
                      <input type="text" placeholder="Search">
                      <button><i class="fa fa-search"></i></button>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="user">
                      <div class="dropdown">
                          @if(Auth::check())
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              {{ Auth::user()->name }} {{-- Display the user's name --}}
                          </a>
                          <div class="dropdown-menu">
                              <a href="{{route('profile') }}" class="dropdown-item">Profile</a>
                              <a href="{{-- route('logout') --}}" class="dropdown-item"
                                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                              <form id="logout-form" action="{{-- route('logout') --}}" method="POST" class="d-none">
                                  @csrf
                              </form>
                          </div>
                          @else
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account</a>
                          <div class="dropdown-menu">
                              <a href="{{ route('admin.login') }}" class="dropdown-item">Login</a>
                              <a href="{{-- route('register') --}}" class="dropdown-item">Register</a>
                          </div>
                          @endif
                      </div>



                      <div class="cart">
                          <i class="fa fa-cart-plus"></i>
                          <span>(0)</span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>