  <div class="top-header">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-md-3">
                  <div class="logo">
                      <a href="{{ route('index') }}">
                          <img src="fontend/img/logo.png" alt="Logo">
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
                      @if(session()->has('user_name'))
                      <div class="dropdown">
                          <a href="fontend/#" class="dropdown-toggle" data-toggle="dropdown">My Account</a>
                          <div class="dropdown-menu">
                              <a href="{{ route("admin.login") }}" class="dropdown-item">Login</a>
                              <a href="fontend/#" class="dropdown-item">Register</a>
                          </div>
                      </div>
                      <div class="cart">
                          <i class="fa fa-cart-plus"></i>
                          <span>(0)</span>
                      </div>
                      @else
                      <p>Welcome, Guest!</p>
                      @endif

                      <div class="dropdown">
                          <a href="fontend/#" class="dropdown-toggle" data-toggle="dropdown">My Account</a>
                          <div class="dropdown-menu">
                              <a href="{{ route("admin.login") }}" class="dropdown-item">Login</a>
                              <a href="fontend/#" class="dropdown-item">Register</a>
                          </div>
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