{{ Html::script('jquery/jquery.min.js') }}
{{ Html::script('bootstrap/js/bootstrap.min.js') }}
{{ Html::script('admin-lte/js/adminlte.min.js') }}
{{ Html::script('datatables.net-bs/js/jquery.dataTables.min.js') }}
{{ Html::script('datatables.net-bs/js/dataTables.bootstrap.min.js') }}
<script type="text/javascript">
    $('.alert').fadeOut(8000);
</script>
<!-- {{ Html::script('js/handlebars.min.js') }} -->
<!-- {{ Html::script('js/notification.js') }} -->

@yield('scripts')
