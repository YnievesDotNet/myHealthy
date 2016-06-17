@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 toppad">
            <div class="panel fresh-color panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $service->name }}</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-8">{!! $service->description !!}</div>
                    <div class="col-md-4"
                         style="background-color: #973634; color: white; border-radius: 5px;">{!! $service->prerequisites !!}</div>
                </div>
                <div class="panel-footer">
                    {!! Button::primary()->withIcon(Icon::edit())->withAttributes(['type' => 'button', 'data-toggle' => 'tooltip', 'data-original-title' => trans('app.btn.edit')])->asLinkTo( route('manager.business.service.edit', [$service->business, $service]) ) !!}
                    {!! Button::danger()->withIcon(Icon::trash())->withAttributes(['type' => 'button', 'data-toggle' => 'tooltip', 'data-original-title' => trans('manager.service.btn.delete'), 'data-method'=>'DELETE', 'data-confirm'=>'Delete?'])->asLinkTo( route('manager.business.service.destroy', [$service->business, $service]) ) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function () {
            var panels = $('.user-infos');
            var panelsButton = $('.dropdown-user');
            panels.hide();

            //Click dropdown
            panelsButton.click(function () {
                //get data-for attribute
                var dataFor = $(this).attr('data-for');
                var idFor = $(dataFor);

                //current button
                var currentButton = $(this);
                idFor.slideToggle(400, function () {
                    //Completed slidetoggle
                    if (idFor.is(':visible')) {
                        currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
                    }
                    else {
                        currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
                    }
                })
            });


            $('[data-toggle="tooltip"]').tooltip();

            $('button').click(function (e) {
                e.preventDefault();
                alert("This is a demo.\n :-)");
            });
        });

        (function () {

            var laravel = {
                initialize: function () {
                    this.methodLinks = $('a[data-method]');

                    this.registerEvents();
                },

                registerEvents: function () {
                    this.methodLinks.on('click', this.handleMethod);
                },

                handleMethod: function (e) {
                    var link = $(this);
                    var httpMethod = link.data('method').toUpperCase();
                    var form;

                    // If the data-method attribute is not PUT or DELETE,
                    // then we don't know what to do. Just ignore.
                    if ($.inArray(httpMethod, ['PUT', 'DELETE']) === -1) {
                        return;
                    }

                    // Allow user to optionally provide data-confirm="Are you sure?"
                    if (link.data('confirm')) {
                        if (!laravel.verifyConfirm(link)) {
                            return false;
                        }
                    }

                    form = laravel.createForm(link);
                    form.submit();

                    e.preventDefault();
                },

                verifyConfirm: function (link) {
                    return confirm(link.data('confirm'));
                },

                createForm: function (link) {
                    var form =
                            $('<form>', {
                                'method': 'POST',
                                'action': link.attr('href')
                            });

                    var token =
                            $('<input>', {
                                'type': 'hidden',
                                'name': '_token',
                                'value': '{{{ csrf_token() }}}' // hmmmm...
                            });

                    var hiddenInput =
                            $('<input>', {
                                'name': '_method',
                                'type': 'hidden',
                                'value': link.data('method')
                            });

                    return form.append(token, hiddenInput)
                            .appendTo('body');
                }
            };

            laravel.initialize();

        })();
    </script>
@endsection