<!-- Modernizer & jQuery JS -->
<script src="{{ asset('/js/vendor/modernizr-3.11.2.min.js') }}"></script>
{{-- <script src="{{ asset('/js/vendor/jquery-3.5.1.min.js') }}"></script> --}}

<script src="{{ asset('js/vendor/jquery-3.6.0.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('/js/plugins/bootstrap.min.js') }}"></script>

<!-- Plugins JS -->
<script src="{{ asset('/js/plugins/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('/js/plugins/ajax-contact.js') }}"></script>
<script src="{{ asset('/js/plugins/appear.js') }}"></script>
<script src="{{ asset('/js/plugins/odometer.min.js') }}"></script>
<script src="{{ asset('/js/plugins/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('/js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('/js/plugins/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('/js/plugins/jquery.zoom.min.js') }}"></script>

{{-- Sweetalert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('.odometer').each(function() {
            const countTo = $(this).data('count-to');
            $(this).html(countTo);
            $(this).trigger('update', [countTo]);
        });
    });
</script>


