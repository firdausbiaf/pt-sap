<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    
    <!-- Letakkan kode style di sini -->
    <style>
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000; /* Sesuaikan sesuai kebutuhan */
        }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #910000;">
    <div class="container">
    <img src="{{ asset('images\jagad-group.png') }}" alt="logo" height="50" class="d-inline-block align-text-top">     
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                {{-- <a class= "nav-link {{ Request::is('course') ? 'active' : '' }} "  href="/course"><i class="bi bi-book-half mx-2"></i>Bimbel</a> --}}
                </li>
            </ul>


            <ul class="navbar-nav ms-auto">
                @auth
                <!-- @if(auth()->user()->role == 'member')
                <li class="nav-item">
                    <a class= "nav-link {{ Request::is('courseMember') ? 'active' : '' }}"  href="/courseMember"><i class="bi bi-journal-text mx-2"></i>My Class</a>
                </li>
                <div class="vr" style="color :white; margin: 0px 8px 0px 8px;"></div>
                @endif -->
                <li class="nav-item dropdown">            
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #FFFFFF;">
                      Welcome back, {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      @if(auth()->user()->role == 'admin')
                      <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-clipboard-minus"></i> My Dashboard</a></li>
                      @else
                      <!-- <li><a class="dropdown-item" href="/transaksiMember"><i class="bi bi-menu-button-wide"></i> My Transaction</a></li> -->
                      @endif
                      <!-- <li><hr class="dropdown-divider"></li> -->
                      <li>
                          <form action="/logout" action="get">
                              @csrf
                              <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-left"></i> Logout</button>
                          </form>
                       
                    </ul>
                  </li>
                @else
                <li>
                    <li class="nav-item">
                        <a class="nav-link " href="/register"><i class="bi bi-box-arrow-up"></i> Register</a>
                </li>
                <li>
                    <li class="nav-item">
                        <a class="nav-link " href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                </li>
                @endauth
            </ul>
           
        </div>
    </div>
    </nav>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>