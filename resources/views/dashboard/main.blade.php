<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>{{ $title }} - Speech To Text</title>
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <!-- CSS files -->
  <link href="{{ asset('plugins/tabler/dist/css/tabler.min.css') }}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{ asset('plugins/toast/dist/simple-notify.min.css') }}" type="text/css">
  <script src="{{ asset('plugins/toast/dist/simple-notify.min.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }

    .navbar-nav li.active {
      background-color: rgba(20, 118, 255, 0.1);
      font-weight: 500;
    }

    li.nav-item:hover {
      font-weight: 500;
    }
  </style>
  @yield('custom-css')
</head>

<body>
  <script src="{{ asset('plugins/tabler/dist/js/demo-theme.min.js?1669759017') }}"></script>

  <div class="page">
    @include('dashboard.partials.sidebar')

    @include('dashboard.partials.header')

    <div class="page-wrapper">
      @yield('content')
      @include('dashboard.partials.footer')
    </div>
  </div>

  {{-- Modal need login --}}
  <div class="modal modal-blur fade" id="modalLogin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-warning"></div>
        <div class="modal-body text-center py-4">
          <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-warning icon-lg" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 9v2m0 4v.01" />
            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
          </svg>
          <h3>You need to login first!</h3>
          <div class="text-muted">You need to login to access this feature</div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                  Cancel
                </a></div>
              <div class="col">
                <a class="btn btn-warning w-100" href="{{ route('auth.index') }}">
                  Login
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('plugins/tabler/dist/js/tabler.min.js?1669759017') }}" defer></script>
  <script src="{{ asset('plugins/tabler/dist/js/demo.min.js?1669759017') }}" defer></script>

  <script>
    @if (session('success'))
      toastr('success', 'Berhasil', '{{ session('success') }}')
    @endif
    @if (session('error'))
      toastr('error', 'Gagal', '{{ session('error') }}')
    @endif

    const changeDateTime = () => {
      const dateTimeContainer = document.getElementById('datetime');
      const now = new Date();
      const date = now.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
      const time = now.toLocaleTimeString('it-IT', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
      });
      dateTimeContainer.innerHTML = `${date} - ${time}`;
    }
    document.addEventListener('DOMContentLoaded', changeDateTime);
    setInterval(changeDateTime, 1000);

    function toastr(status = 'success', title = 'Toast Title', text = 'Toast Text') {
      new Notify({
        status: status,
        title: title,
        text: text,
        effect: 'fade',
        speed: 300,
        showIcon: true,
        showCloseButton: true,
        autoclose: true,
        autotimeout: 3000,
        gap: 20,
        distance: 20,
        type: 3,
        position: 'right top',
      })
    }

    @if (auth()->guest())
      const needLogin = document.querySelectorAll('.need-to-login');
      needLogin.forEach((el) => {
        el.addEventListener('click', (e) => {
          e.preventDefault();
          $('#modalLogin').modal('show');
        });
      });
    @endif
  </script>

  @yield('library-js')
  @yield('custom-js')
</body>

</html>
