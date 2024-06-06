<title>{{ $title ?? env('APP_NAME') }}</title>

<meta charset="utf-8">
<meta name="csrf" content="{{ csrf_token() }}">

<link href="/assets/css/vendor/bootstrap.min.css" rel="stylesheet">
<link href="/assets/css/main.css" rel="stylesheet">

<script src="/assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="/assets/js/vendor/axios.min.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/form.js"></script>
<!-- <script src="/assets/js/http.js"></script> -->
<script src="/assets/js/http2.js"></script>
<script src="/assets/js/auth.js" defer></script>
<script src="/assets/js/notes.js" defer></script>
<script src="/assets/js/profile.js" defer></script>