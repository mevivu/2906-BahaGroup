<script src="{{ asset('public/user/assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/user/assets/js/jquery.js') }}"></script>
<script src="{{ asset('public/user/assets/fotorama-4.6.4/fotorama.js') }}"></script>
<script src="{{ asset('public/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('libs-js')
<script type="module" src="{{ asset('public/admin/assets/js/i18n.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/setup.js') }}"></script>
<script src="{{ asset('public/user/assets/js/home.js') }}"></script>
@stack('custom-js')
