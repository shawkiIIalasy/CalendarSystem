<nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            @guest
                Shawki Calendar
            @else
                Shawki Calendar || {{session('client')->name}}
            @endguest
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre onclick="makeAsRead()">
                            <span class="fa fa-globe" id="count"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            @foreach(auth()->user()->unreadNotifications as $notification)
                                <a class="dropdown-item" href="">
                                    {{ $notification->data['data'] }}
                                    <button class="btn btn-secondary">Yes</button>
                                    <button class="btn btn-secondary">No</button>
                                    <button class="btn btn-secondary">Maybe</button>
                                </a>
                            @endforeach
                            @foreach(auth()->user()->readNotifications as $notification)
                                <a class="dropdown-item" href="">
                                    {{ $notification->data['data'] }}
                                    <button class="btn btn-secondary">Yes</button>
                                    <button class="btn btn-secondary">No</button>
                                    <button class="btn btn-secondary">Maybe</button>
                                </a>

                            @endforeach

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        getNotificationsCount();
    });
    function getNotificationsCount() {
        $.ajax({
            type: 'get', //THIS NEEDS TO BE GET
            url: '/getNotificationsCount',
            success: function (data) {
                if(data!=0)
                {
                    var bell=document.getElementById('count');
                    var badage=document.createElement('i');
                    badage.innerHTML=data;
                    bell.appendChild(badage);
                }
            }
        });
    }
    function makeAsRead() {
        $.ajax({
            type: 'get', //THIS NEEDS TO BE GET
            url: '/makeAsRead',
            success: function (data) {
               getNotificationsCount();
            }
        });
    }
</script>
