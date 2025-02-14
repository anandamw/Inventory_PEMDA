  <!--**********************************
            Sidebar start
        ***********************************-->
  <div class="deznav">
      <div class="deznav-scroll">
          <ul class="metismenu" id="menu">

              @if (auth()->user()->role == 'admin')
                  <li><a href="/dashboard" class="" aria-expanded="false">
                          <i class="bi bi-speedometer2"></i>
                          <span class="nav-text">Dashboard</span>
                      </a>
                  </li>
                  <li><a href="/item" class="" aria-expanded="false">
                          <i class="bi bi-box-seam"></i>
                          <span class="nav-text">Items</span>
                      </a>
                  </li>
                  <li><a href="/history" class="" aria-expanded="false">
                          <i class="bi bi-clock-history"></i>
                          <span class="nav-text">History</span>
                      </a>
                  </li>
                  <li><a href="/user" class="" aria-expanded="false">
                          <i class="bi bi-people"></i>
                          <span class="nav-text">Users</span>
                      </a>
                  </li>
                  <li><a href="/rekapitulasi" class="" aria-expanded="false">
                          <i class="bi bi-book"></i>
                          <span class="nav-text">Rekapitulasi</span>
                      </a>
                  </li>
                  <li><a href="/logout" class="" aria-expanded="false">
                          <i class="bi bi-box-arrow-right"></i>
                          <span class="nav-text">Logout</span>
                      </a>
                  </li>
              @else
                  <li><a href="/dashboard" class="" aria-expanded="false">
                          <i class="bi bi-speedometer2"></i>
                          <span class="nav-text">Dashboard</span>
                      </a>
                  </li>
                  <li><a href="/item" class="" aria-expanded="false">
                          <i class="bi bi-box-seam"></i>
                          <span class="nav-text">Items</span>
                      </a>
                  </li>

                  <li><a href="/logout" class="" aria-expanded="false">
                          <i class="bi bi-box-arrow-right"></i>
                          <span class="nav-text">Logout</span>
                      </a>
                  </li>
              @endif



          </ul>
      </div>
  </div>
  <!--**********************************
            Sidebar end
        ***********************************-->
