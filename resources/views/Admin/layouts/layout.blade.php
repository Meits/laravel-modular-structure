<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BleeCore</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{asset('admin/global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- /global stylesheets -->

    {{--@include('ckfinder::setup')--}}

    <!-- Core JS files -->
    <script src="{{asset('admin/global_assets/js/main/jquery.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->

    <script src="{{asset('admin/global_assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>

    <script src="{{asset('admin/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>

    <script src="{{asset('admin/global_assets/js/plugins/forms/validation/validate.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/forms/inputs/touchspin.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/editors/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/forms/styling/switch.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/notifications/noty.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/notifications/bootbox.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/visualization/c3/c3.min.js')}}"></script>


    <script src="{{asset('admin/assets/js/app.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/demo_pages/form_validation.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/demo_pages/form_checkboxes_radios.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/demo_pages/components_modals.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/demo_pages/dashboard.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom.js')}}"></script>

    <script src="{{asset('admin/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/demo_pages/form_select2.js')}}"></script>



    <script>


        var BootstrapMultiselect = function () {
            //
            // Setup module components
            //
            // Default file input style
            var _componentMultiselect = function () {
                if (!$().multiselect) {
                    console.warn('Warning - bootstrap-multiselect.js is not loaded.');
                    return;
                }
                // Basic examples
                // ------------------------------
                // Limit options number
                if($('.multiselect').length) {
                    $('.multiselect').multiselect({
                        numberDisplayed: 4,
                        onChange: function(option, checked) {
                            // Get selected options.
                            var selectedOptions = $('.multiselect option:selected');

                            if (selectedOptions.length >= 4) {
                                // Disable all other checkboxes.
                                var nonSelectedOptions = $('.multiselect option').filter(function() {
                                    return !$(this).is(':selected');
                                });

                                nonSelectedOptions.each(function() {
                                    var input = $('input[value="' + $(this).val() + '"]');
                                    input.prop('disabled', true);
                                    input.parent('li').addClass('disabled');
                                });
                            }
                            else {
                                // Enable all checkboxes.
                                $('.multiselect option').each(function() {
                                    var input = $('input[value="' + $(this).val() + '"]');
                                    input.prop('disabled', false);
                                    input.parent('li').addClass('disabled');
                                });
                            }
                        }
                    });
                }
            };

            //
            // Return objects assigned to module
            //

            return {
                init: function () {
                    _componentMultiselect();
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function () {
            BootstrapMultiselect.init();
        });


        // Setup module
        // ------------------------------
        var CKEditor = function () {
            // Setup CKEditor
            var _componentCKEditor = function () {
                if (typeof CKEDITOR == 'undefined') {
                    console.warn('Warning - ckeditor.js is not loaded.');
                    return;
                }
                // Setup
                let elem = document.querySelectorAll('.editor');
                if (elem.length) {
                    elem.forEach(function (item) {
                        var editor = CKEDITOR.replace(item, {
                            height: 200,
                            extraPlugins: 'youtube',
                            //height: 300,

                            // Upload images to a CKFinder connector (note that the response type is set to JSON).
                           // uploadUrl: '/administrator/image/upload',

                            // Configure your file manager integration. This example uses CKFinder 3 for PHP.
                            //filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
                            //filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
                            //filebrowserUploadUrl: '/administrator/image/upload',
                            //filebrowserImageUploadUrl: '/administrator/image/upload',

                            // Use named CKFinder browser route
                            /////////filebrowserBrowseUrl: '{{--{{ route('ckfinder_browser') }}--}}',
                            // Use named CKFinder connector route
                            //////////filebrowserUploadUrl: '{{--{{ route('ckfinder_connector') }}--}}?command=QuickUpload&type=Files'

                        });


                    });

                }

            };
            //
            // Return objects assigned to module
            //
            return {
                init: function () {
                    _componentCKEditor();
                }
            }
        }();

        // Initialize module
        // ------------------------------
        document.addEventListener('DOMContentLoaded', function () {
            CKEditor.init();
        });

        // Setup module
        // ------------------------------

        var NotyJgrowl = function () {
            //
            // Setup Noty.js
            var _componentNoty = function () {
                if (typeof Noty == 'undefined') {
                    console.warn('Warning - noty.min.js is not loaded.');
                    return;
                }
                // Override Noty defaults
                Noty.overrideDefaults({
                    theme: 'limitless',
                    layout: 'topRight',
                    type: 'alert',
                    timeout: 2500
                });

                new Noty({
                    text: '{{session('message',null)}}',
                    type: '{{session('status',null)}}'
                }).show();
            };

            //
            // Return objects assigned to module
            //
            return {
                init: function () {
                    _componentNoty();
                }
            }
        }();

        // Initialize module
        // ------------------------------
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('status'))
                NotyJgrowl.init();
            @endif
        });
    </script>

    <!-- /theme JS files -->

</head>

<body>

@yield('header')

<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
@yield('navigation')
<!-- /main sidebar -->


    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Content area -->
    @yield('content')
    <!-- /content area -->

        <!-- Footer -->

    @yield('footer')
    @yield('scripts')
    <!-- /footer -->
    </div>
    <!-- /main content -->
</div>
<!-- /page content -->
<div id="confirm_delete_contacts" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Do you want to remove this record?</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link legitRipple" data-dismiss="modal">Close
                    <div class="legitRipple-ripple"
                         style="left: 58.0946%; top: 33.5526%; transform: translate3d(-50%, -50%, 0px); width: 225.278%; opacity: 0;"></div>
                    <div class="legitRipple-ripple"
                         style="left: 38.995%; top: 54.6053%; transform: translate3d(-50%, -50%, 0px); width: 225.278%; opacity: 0;"></div>
                </button>
                <button type="button" class="btn bg-danger legitRipple js-confirm">Delete</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>

