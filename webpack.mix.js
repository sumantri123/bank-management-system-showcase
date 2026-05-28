const mix = require('laravel-mix');
const WebpackObfuscator = require('webpack-obfuscator');
require('laravel-mix-purgecss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/* mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css'); */

// Menggabungkan Bootstrap CSS dengan file CSS lain
mix.styles([       
       'public/html/assets/css/font1.css',
	   'public/html/assets/css/font2.css',
	   'public/html/assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css',
	   'public/html/assets/css/style.css',
	   'public/bank_stiep/plugins/notifications/css/lobibox.min.css',	   
	   'public/html/cdn/npm/bootstrap-icons/font/bootstrap-icons.css',
   ], 'public/css/bankminimobile.css').purgeCss();
   
mix.styles([       
       'public/bank_stiep/plugins/vectormap/jquery-jvectormap-2.0.2.css',
	   'public/bank_stiep/plugins/notifications/css/lobibox.min.css',
	   'public/bank_stiep/plugins/simplebar/css/simplebar.css',
	   'public/bank_stiep/plugins/select2/css/select2.min.css',
	   'public/bank_stiep/plugins/select2/css/select2-bootstrap4.css',	   
	   'public/bank_stiep/plugins/perfect-scrollbar/css/perfect-scrollbar.css',
	   'public/bank_stiep/plugins/metismenu/css/metisMenu.min.css',
	   'public/bank_stiep/plugins/jquery-ui-1.12.1/jquery-ui.min.css',
	   'public/bank_stiep/plugins/jquery-ui-1.12.1/jquery-ui.css',
	   'public/bank_stiep/plugins/datetimepicker/css/classic.css',
	   'public/bank_stiep/plugins/datetimepicker/css/classic.time.css',
	   'public/bank_stiep/plugins/datetimepicker/css/classic.date.css',
	   'public/bank_stiep/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css',
	   'public/bank_stiep/plugins/datatable/css/dataTables.bootstrap5.min.css',
	   'public/bank_stiep/css/pace.min.css',
	   'public/bank_stiep/css/bootstrap.min.css',
	   'public/bank_stiep/css/app.css',
	   'public/bank_stiep/css/icons.css',
	   'public/bank_stiep/css/dark-theme.css',
	   'public/bank_stiep/css/semi-dark.css',
	   'public/bank_stiep/css/header-colors.css',
	   'public/bank_stiep/plugins/sweetalert2/dist/sweetalert2.min.css',	   
   ], 'public/css/bankwebsite.css').purgeCss();   
   
mix.scripts([
		'public/html/assets/js/jquery-3.3.1.min.js', // Bootstrap bundle sudah include Popper.js        
		'public/bank_stiep/js/jquery.validate.min.js',
		'public/additional/js/mobileBanking/global.js',
		'public/html/assets/js/popper.min.js',
		'public/html/assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js',
		'public/html/assets/js/jquery.cookie.js',
		'public/html/assets/js/main.js',
		'public/html/assets/js/color-scheme.js',
		'public/html/assets/vendor/chart-js-3.3.1/chart.min.js',
		'public/html/assets/vendor/progressbar-js/progressbar.min.js',
		'public/html/assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js',
		'public/html/assets/js/app.js',
		'public/bank_stiep/plugins/notifications/js/lobibox.min.js',
		'public/bank_stiep/plugins/notifications/js/notifications.min.js',
		'public/additional/js/mobileBanking/notification-custom-script.js',	
   ], 'public/js/bankminimobile.js');
   
mix.scripts([
		'public/bank_stiep/js/bootstrap.bundle.min.js', // Bootstrap bundle sudah include Popper.js        
		'public/bank_stiep/js/jquery.min.js',
		'public/bank_stiep/js/jquery.validate.min.js',
		'public/bank_stiep/plugins/simplebar/js/simplebar.min.js',
		'public/bank_stiep/plugins/metismenu/js/metisMenu.min.js',
		'public/bank_stiep/plugins/perfect-scrollbar/js/perfect-scrollbar.js',
		'public/bank_stiep/plugins/chartjs/js/Chart.min.js',
		'public/bank_stiep/plugins/vectormap/jquery-jvectormap-2.0.2.min.js',
		'public/bank_stiep/plugins/vectormap/jquery-jvectormap-world-mill-en.js',
		'public/bank_stiep/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js',
		'public/bank_stiep/plugins/sparkline-charts/jquery.sparkline.min.js',
		'public/bank_stiep/plugins/jquery-knob/excanvas.js',
		'public/bank_stiep/plugins/jquery-knob/jquery.knob.js',
		'public/bank_stiep/plugins/sweetalert2/dist/sweetalert2.js',
		'public/bank_stiep/js/index.js',	
		'public/additional/js/global.js',	
		'public/bank_stiep/js/app.js',	
		'public/bank_stiep/js/plugins.js',	
		'public/bank_stiep/plugins/select2/js/select2.min.js',	
		'public/bank_stiep/js/pace.min.js',	
		'public/bank_stiep/plugins/datatable/js/jquery.dataTables.min.js',	
		'public/bank_stiep/plugins/datatable/js/dataTables.bootstrap5.min.js',	
		'public/bank_stiep/plugins/datetimepicker/js/legacy.js',	
		'public/bank_stiep/plugins/datetimepicker/js/picker.js',	
		'public/bank_stiep/plugins/datetimepicker/js/picker.time.js',	
		'public/bank_stiep/plugins/datetimepicker/js/picker.date.js',	
		'public/bank_stiep/plugins/bootstrap-material-datetimepicker/js/moment.min.js',	
		'public/bank_stiep/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js',	
		'public/bank_stiep/plugins/notifications/js/lobibox.min.js',	
		'public/bank_stiep/plugins/notifications/js/notifications.min.js',	
		'public/additional/js/notification-custom-script.js',	
		'public/bank_stiep/plugins/jquery-ui-1.12.1/jquery-ui.min.js',	
		'public/bank_stiep/plugins/jquery-ui-1.12.1/jquery-ui.js',				
   ], 'public/js/bankwebsite.js');   
   
if (mix.inProduction()) {
    mix.version();
}    