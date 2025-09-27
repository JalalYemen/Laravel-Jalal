<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHEOUT Store</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .product-card { transition: transform .2s; }
        .product-card:hover { transform: scale(1.05); }
    </style>
</head>
<body>

    @include('layouts.public-navbar')

    {{-- Main content from child pages will be injected here --}}
    <main class="container py-5">
        @yield('content')
    </main>

    <footer class="text-center py-4 text-muted">
        <p>&copy; {{ date('Y') }} Jalal's Store. All Rights Reserved.</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>

    {{-- THE GLOBAL BUG-FIX SCRIPT --}}
    <script>
    (function () {
      document.addEventListener('submit', function (e) {
        var form = e.target;
        if (!(form instanceof HTMLFormElement)) return;
        if (e.defaultPrevented) return;
        if (form.dataset.preventDoubleSubmit !== "true") return;
        if (form.dataset._submitted === "true") {
          e.preventDefault();
          return;
        }
        form.dataset._submitted = "true";
        var btns = form.querySelectorAll('button[type="submit"]');
        btns.forEach(function (b) {
          try {
            b.disabled = true;
            if (b.tagName === 'BUTTON') {
              b.setAttribute('data-old-html', b.innerHTML);
              b.innerHTML = b.dataset.loadingText || 'Please wait...';
            }
          } catch (err) { /* silent */ }
        });
      }, true);

      document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.alert.alert-success').forEach(function (al) {
          setTimeout(function () {
            if (al.parentNode) al.parentNode.removeChild(al);
          }, 4000);
        });
      });
    })();
    </script>
</body>
</html>