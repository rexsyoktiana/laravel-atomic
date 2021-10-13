<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('admin-lte')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> --}}

        @include('layouts.navbar')

        @include('layouts.sidebar')

        <div class="content-wrapper">
            @include('layouts.breadcrumb')

            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
        @include('layouts.footer')

    </div>
    @include('layouts.script')
    @yield('script')
</body>

</html>
