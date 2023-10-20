<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title></title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
    <link href="{{ asset('backend/assets/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/toastify.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />


    <link href="{{ asset('backend/assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" />

    <script src="{{ asset('backend/assets/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}"></script>


    <script src="{{ asset('backend/assets/js/toastify-js.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('backend/assets/js/axios.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>





</head>

<body>

    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    <nav class="navbar fixed-top px-0 shadow-sm bg-white">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">
                <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">

                    <img class="nav-logo-sm mx-2" src="{{ asset('backend/assets/images/menu.svg') }}" alt="logo" />
                </span>
                <img class="nav-logo  mx-2" src="{{ asset('backend/assets/images/logo.png') }}" alt="logo" />
            </a>

            <div class="float-right h-auto d-flex">
                <div class="user-dropdown">
                    <img class="icon-nav-img" src="{{ asset('backend/assets/images/user.webp') }}" alt="" />
                    <div class="user-dropdown-content ">
                        <div class="mt-4 text-center">
                            <img class="icon-nav-img" src="{{ asset('backend/assets/images/user.webp') }}"
                                alt="" />
                            <h6>User Name</h6>
                            <hr class="user-dropdown-divider  p-0" />
                        </div>
                        <a href="{{ url('/userProfile') }}" class="side-bar-item">
                            <span class="side-bar-item-caption">Profile</span>
                        </a>
                        <a href="{{ url('/logout') }}" class="side-bar-item">
                            <span class="side-bar-item-caption">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div id="sideNavRef" class="side-nav-open">

        <a href="{{ url('/dashboard') }}" class="side-bar-item">
            <i class="fa fa-chevron-circle-right  text-dark"></i>
            <span class="side-bar-item-caption">Dashboard</span>
        </a>





        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Home</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('hero.page') }}">Hero</a></li>
                <li><a class="dropdown-item" href="{{ route('about.page') }}">About Me</a></li>
                <li><a class="dropdown-item" href="{{ route('social.link') }}">Social Link</a></li>
            </ul>
        </div><br>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Resume</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('experience.page') }}">Experience</a></li>
                <li><a class="dropdown-item" href="{{ route('education.page') }}">Education</a></li>
                <li><a class="dropdown-item" href="{{ route('skill.page') }}">Professional Skills </a></li>
                <li><a class="dropdown-item" href=" {{ route('language.page') }}">Languages</a></li>
            </ul>
        </div><br>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Projects</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href=" {{ route('project.page') }}">Projects</a></li>

            </ul>
        </div>




    </div>


    <div id="contentRef" class="content">
        @yield('content')
    </div>



    <script>
        function MenuBarClickHandler() {
            let sideNav = document.getElementById('sideNavRef');
            let content = document.getElementById('contentRef');
            if (sideNav.classList.contains("side-nav-open")) {
                sideNav.classList.add("side-nav-close");
                sideNav.classList.remove("side-nav-open");
                content.classList.add("content-expand");
                content.classList.remove("content");
            } else {
                sideNav.classList.remove("side-nav-close");
                sideNav.classList.add("side-nav-open");
                content.classList.remove("content-expand");
                content.classList.add("content");
            }
        }
    </script>

</body>

</html>
