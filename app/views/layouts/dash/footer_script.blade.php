@section('footer_script')



<!-- Global -->
<script data-id="App.Config">
    var App = {};	var basePath = '',
        commonPath = '{{{ asset("assets/")}}}',
        rootPath = '../',
        DEV = false,
        componentsPath = '{{{ asset("assets/components/")}}}';

    var primaryColor = '#5577b4',
        dangerColor = '#b55151',
        successColor = '#609450',
        infoColor = '#4a8bc2',
        warningColor = '#ab7a4b',
        inverseColor = '#45484d';

    var themerPrimaryColor = primaryColor;

</script>
<script src="{{{ asset('assets/library/bootstrap/js/bootstrap.min.js?v=v2.0.0-rc8&sv=v0.0.1.2')}}}"></script>
<script src="{{{ asset('assets/plugins/core_nicescroll/jquery.nicescroll.min.js?v=v2.0.0-rc8&sv=v0.0.1.2')}}}"></script>
<script src="{{{ asset('assets/plugins/core_breakpoints/breakpoints.js?v=v2.0.0-rc8&sv=v0.0.1.2')}}}"></script>
<script src="{{{ asset('assets/plugins/core_preload/pace.min.js?v=v2.0.0-rc8&sv=v0.0.1.2')}}}"></script>
<script src="{{{ asset('assets/components/core_preload/preload.pace.init.js?v=v2.0.0-rc8&sv=v0.0.1.2')}}}"></script>
<script src="{{{ asset('assets/plugins/menu_sidr/jquery.sidr.js?v=v2.0.0-rc8')}}}"></script>
<script src="{{{ asset('assets/components/menus/menus.sidebar.chat.init.js?v=v2.0.0-rc8')}}}"></script>
<script src="{{{ asset('assets/plugins/other_mixitup/jquery.mixitup.min.js?v=v2.0.0-rc8&sv=v0.0.1.2')}}}"></script>
<script src="{{{ asset('assets/plugins/other_mixitup/mixitup.init.js?v=v2.0.0-rc8&sv=v0.0.1.2')}}}"></script>
<script src="{{{ asset('assets/components/core/core.init.js?v=v2.0.0-rc8')}}}"></script>
<script src="{{{ asset('assets/components/forms_elements_fuelux-checkbox/fuelux-checkbox.init.js?v=v2.0.0-rc8&sv=v0.0.1.2')}}}"></script>
<script src="{{{ asset('assets/components/forms_elements_fuelux-radio/fuelux-radio.init.js?v=v2.0.0-rc8&sv=v0.0.1.2')}}}"></script>
<script src="{{{ asset('assets/plugins/forms_elements_bootstrap-select/js/bootstrap-select.js?v=v2.0.0-rc8&sv=v0.0.1.2')}}}"></script>
<script src="{{{ asset('assets/components/forms_elements_bootstrap-select/bootstrap-select.init.js?v=v2.0.0-rc8&sv=v0.0.1.2')}}}"></script>
<script src="{{ asset('assets/plugins/media_blueimp/js/blueimp-gallery.min.js?v=v2.0.0-rc8&sv=v0.0.1.2') }}"></script>
<script src="{{ asset('assets/plugins/media_blueimp/js/jquery.blueimp-gallery.min.js?v=v2.0.0-rc8&sv=v0.0.1.2') }}"></script>
{{--<script src="//oss.maxcdn.com/jquery.form/3.50/jquery.form.min.js"></script>--}}




@show