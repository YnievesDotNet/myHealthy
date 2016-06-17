@if (Session::has('flash_notification.message'))
    @if (Session::has('flash_notification.overlay'))
        @include('flash::modal', ['modalClass' => 'flash-modal', 'title' => Session::get('flash_notification.title'), 'body' => Session::get('flash_notification.message')])
    @else
        <script>
            $.notify("{!! Session::get('flash_notification.message')  !!}", {
                autoHideDelay: 6000,
                showAnimation: 'slideDown',
                showDuration: 500,
                hideAnimation: 'slideUp',
                hideDuration: 300,
                className: '{{ Session::get('flash_notification.level') }} alert-{{ Session::get('flash_notification.level') }} alert fresh-color',
                clickToHide: true,
                arrowShow: false,
                autoHide: true,
            });
        </script>
    @endif
@endif
