const mix = require('laravel-mix');

mix.styles([
    'resources/asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
    'resources/asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
    'resources/asset/plugins/jqvmap/jqvmap.min.css',
    'resources/asset/dist/css/adminlte.min.css',
    'resources/asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
    'resources/asset/plugins/daterangepicker/daterangepicker.css',
    'resources/asset/plugins/summernote/summernote-bs4.css',
    'resources/asset/plugins/bootstrap/bootstrap.css',
    'resources/asset/plugins/bootstrap/bootstrap.min.css',
    'resources/asset/css/estilo.css'
], 'public/css/plantilla.css')
.scripts([
    'resources/asset/plugins/jquery/jquery.min.js',
    'resources/asset/plugins/jquery-ui/jquery-ui.min.js',
    'resources/asset/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/asset/plugins/bootstrap/js/bootstrap.min.js',
    'resources/asset/plugins/chart.js/Chart.min.js',
    'resources/asset/plugins/jqvmap/jquery.vmap.min.js',
    'resources/asset/plugins/jqvmap/maps/jquery.vmap.usa.js',
    'resources/asset/plugins/jquery-knob/jquery.knob.min.js',
    'resources/asset/plugins/moment/moment.min.js',
    'resources/asset/plugins/daterangepicker/daterangepicker.js',
    'resources/asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
    'resources/asset/plugins/summernote/summernote-bs4.min.js',
    'resources/asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
    'resources/asset/dist/js/adminlte.js',
    'resources/asset/dist/js/demo.js'
],'public/js/plantilla.js')
.js(['resources/js/app.js'], 'public/js/app.js');
