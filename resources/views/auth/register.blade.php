<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Register - Speech To Text</title>
  <!-- CSS files -->
  <link href="{{ asset('plugins/tabler/dist/css/tabler.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/tabler/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/tabler/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/tabler/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/tabler/dist/css/demo.min.css') }}" rel="stylesheet" />
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('plugins/toast/dist/simple-notify.min.css') }}" />
  <script src="{{ asset('plugins/toast/dist/simple-notify.min.js') }}"></script>
  <style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }
  </style>
</head>

<body class="d-flex flex-column">
  <script src="{{ asset('plugins/tabler/dist/js/demo-theme.min.js?1669759017') }}"></script>
  <div class="page">
    <div class="container container-tight py-4">
      <div class="text-center mb-3 mt-4">
        <a class="fs-3 navbar-brand navbar-brand-autodark">
          <img src="{{ asset('img/logo.png') }}" width="30" height="30" alt="" class="me-2">
          Speech To Text
        </a>
      </div>
      <div class="card card-md">
        <div class="card-body">
          <h2 class="text-center mb-4">Register</h2>
          <form action="{{ route('auth.store') }}" method="POST" autocomplete="off" novalidate>
            @csrf
            <div class="mb-3">
              <label class="form-label required">Nama</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama anda" id="name" value="{{ old('name') }}">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label required">Email</label>
              <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email anda" id="email" value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-2">
              <label class="form-label required">
                Password
              </label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password anda" id="password" value="{{ old('password') }}">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label required">
                Konfirmasi Password
              </label>
              <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Masukkan konfirmasi password anda" id="password_confirmation" value="{{ old('password_confirmation') }}">
              @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </div>
          </form>
        </div>
        <div class="text-center text-muted pb-4">
          Sudah punya akun? <a href="{{ route('auth.index') }}">Login disini</a>
        </div>
      </div>
      <div class="text-center text-muted mt-5">
        © All rights reserved - Speech To Text
      </div>
    </div>
  </div>
  <script src="{{ asset('plugins/tabler/dist/js/tabler.min.js?1669759017') }}" defer></script>
  <script src="{{ asset('plugins/tabler/dist/js/demo.min.js?1669759017') }}" defer></script>
  <script>
    @if (session('error'))
      toastr('error', 'Gagal', '{{ session('error') }}')
    @endif

    @if (session('success'))
      toastr('success', 'Berhasil', '{{ session('success') }}')
    @endif

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

    const btnShowPassword = document.querySelector('#btnShowPassword')
    const inputPassword = document.querySelector('#password')

    btnShowPassword.addEventListener('click', function() {
      if (inputPassword.type === 'password') {
        inputPassword.type = 'text'
        btnShowPassword.innerHTML =
          `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 3l18 18"></path>
                        <path d="M10.584 10.587a2 2 0 0 0 2.828 2.83"></path>
                        <path d="M9.363 5.365a9.466 9.466 0 0 1 2.637 -.365c4 0 7.333 2.333 10 7c-.778 1.361 -1.612 2.524 -2.503 3.488m-2.14 1.861c-1.631 1.1 -3.415 1.651 -5.357 1.651c-4 0 -7.333 -2.333 -10 -7c1.369 -2.395 2.913 -4.175 4.632 -5.341"></path>
                    </svg>`;
      } else {
        inputPassword.type = 'password'
        btnShowPassword.innerHTML =
          `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                        <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                    </svg>`
      }
    })
  </script>
</body>

</html>
