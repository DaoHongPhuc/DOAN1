@extends('layout.index')

@section('content')
@php
    $user = Auth::user();
    $id = $user->id;
@endphp
<div class="container">
    <div class="title-index-parent-r">
        <h2 class="title-index-r">KHU VỰC CÁ NHÂN</h2>
    </div>
    <div class="row">
        @include('pages.menu')
        
        <div class="col-md-10">
            @yield('job-content')
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $(function() {
        var Accordion = function(el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;

            // Variables privadas
            var links = this.el.find('.link');
            // Evento
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
        }

        Accordion.prototype.dropdown = function(e) {
            var $el = e.data.el;
                $this = $(this),
                $next = $this.next();

            $next.slideToggle();
            $this.parent().toggleClass('open');

            if (!e.data.multiple) {
                $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            };
        }	

        var accordion = new Accordion($('#accordion'), false);
    });
    </script>
@endsection