  <!--**********************************
            Sidebar start
        ***********************************-->

  <style>
      .title-container li a {
          border: none;
          border-radius: 12px;
          box-shadow: inset 4px 4px 6px var(--secondary-dark),
              inset -4px -4px 6px var(--primary);

          outline: none;
          margin-top: 13px;
          width: 100%;
      }

      .separator hr {
          border: none;
          height: 2px;
          background: white;

      }
  </style>


  <div class="deznav">
      <div class="deznav-scroll">
          <div class="title-container">
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
                      <li><a href="/instansi" class="" aria-expanded="false">
                              <i class="bi bi-building"></i>
                              <span class="nav-text">Instansi</span>
                          </a>
                      </li>
                      <li class="separator">
                          <hr>
                      </li>
                      <li><a href="/perbaikan" class="" aria-expanded="false">
                              <i class="bi bi-tools"></i> </i>
                              <span class="nav-text">Perbaikan</span>
                          </a>
                      </li>
                      <li><a href="/aset" class="" aria-expanded="false">
                              <i class="bi bi-briefcase"></i>
                              <span class="nav-text">Assets</span>
                          </a>
                      </li>
                      <li class="separator">
                          <hr>
                      </li>
                      <li><a href="/rekapitulasi" class="" aria-expanded="false">
                              <i class="bi bi-book"></i>
                              <span class="nav-text">Rekapitulasi</span>
                          </a>
                      </li>
                      <li class="separator">
                          <hr>
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
                      <li class="separator">
                          <hr>
                      </li>
                      <li><a href="/perbaikan" class="" aria-expanded="false">
                              <i class="bi bi-tools"></i> </i>
                              <span class="nav-text">Perbaikan</span>
                          </a>
                      </li>
                      <li class="separator">
                          <hr>
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
  </div>
  <!--**********************************
            Sidebar end
        ***********************************-->
