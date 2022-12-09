<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon"
          href="https://scontent.fcai20-4.fna.fbcdn.net/v/t1.6435-9/123707348_389032752463184_7400384449066140568_n.png?_nc_cat=102&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=Cs24e_37BvQAX_c-uSC&_nc_ht=scontent.fcai20-4.fna&oh=00_AT8fc1eLnOZ8-X5NHOJGZrbAB7XKAhg3M04RskWyx-HZ-A&oe=630E7D2D">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title','')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/alert.js') }}" defer></script>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}" defer></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <script src="{{ asset('js/ap.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{--
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"> --}}


    <style>
        .btn-delete {
            background: url('/images/trash.svg');
            background-repeat: round;
            background-size: 1.1rem 1.1rem;
            padding-bottom: 0px;
            padding-top: 0px;
            padding-left: 20px;
            border: 0px;
            outline: none
        }

        a {
            color: black
        }

        .over {
            position: unset !important;
            z-index: unset !important;
        }
    </style>



    @livewireStyles

</head>

<body>

    <div class="overlay">
        <div class="loader"></div>
    </div>
    <div id="app">
        <div id="main">
            <div class="container mb-5">

                @if (isset(Auth::user()->name))

                <nav style="margin-bottom: 65px;">
                    <div class="nav-fostrap">
                        <ul>
                            <li>
                                <h5 @if (Auth::user()->admin == 1)
                                    class="progress-bar progress-bar-striped h-100 w-100">
                                    @elseif (Auth::user()->admin == 2)
                                    class="progress-bar progress-bar-striped bg-success h-100 w-100">
                                    @else
                                    class="progress-bar progress-bar-striped bg-warning bg-success h-100 w-100">

                                    @endif
                                    {{ Auth::user()->name}}

                                </h5>
                            </li>


                            <li class="text-center lead"><a href="/home">الــرئيسية</a></li>
                            <li class="text-center lead"><a href="/projects">الــحــالات</a></li>
                            {{-- <li class="text-center lead"><a href="/dentaldate">التقويم</a></li> --}}
                            <li class="text-center lead"><a href="/lap">المعمل</a></li>

                            <li class="text-center lead"><a @if(count(\App\Models\Reg::where('status', 0)->get()) != 0)
                                    class = 'btn btn-success text-warning'
                                    @endif
                                    href="/reg">التسجيلات الالكترونية</a></li>
                            <li class="text-center lead"><a href="/note">Notes</a></li>

                            @if (auth()->user()->admin == 2)
                            <li class="text-center " style="font-size: 15px"><a href="/register">Register New Account</a></li>
                            <li class="text-center " style="font-size: 15px"><a href="/users">Manage</a></li>
                            @endif
                            <li class="text-center lead"><a href='/logout'>Log Out</a></li>
                            {{-- <li><a href="">Tips</a></li> --}}
                        </ul>
                        </li>

                        {{-- <li><a href="">Tools</a></li>
                        <li><a href="">Backlink</a></li> --}}
                        </ul>
                        </li>
                        </ul>
                    </div>
                    <div class="nav-bg-fostrap">
                        <div class="navbar-fostrap"> <span></span> <span></span> <span></span> </div>
                        <a href="/home" class="title-mobile">Elite Dental Center</a>
                    </div>
                </nav>
                @endif

                <div class='content'>
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

        {{-- <main class="py-4">

        </main> --}}
    </div>

    @livewireScripts
</body>



</html>
