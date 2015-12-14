<div id="copyright">
    @if (env('APP_ENV') == 'local')
        <span>{!! Label::danger('LOCAL') !!} <span
                    class="text-danger">&nbsp;{{ trans('app.footer.local') }}</span></span>
    @endif
    @if (env('APP_ENV') == 'demo')
        <span>{!! Label::danger('DEMO') !!} <span
                    class="text-danger">&nbsp;{{ trans('app.footer.demo') }}</span></span>
    @endif
    &nbsp;<span class="pull-right">[[ .:FIND A PRO:. ]] v1.0 - Copyright &copy;
        YnievesDotNet 2007-<?php echo date('Y');?></span>
</div>