@extends('layout.index')

@section('content')
@php
    $user = Auth::user();
    $id = $user->id;
@endphp
<div class="container">

    @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $err)
            {{$err}}. <br>
        @endforeach
    </div>
@endif

@if(session('thongbao'))
    <div class="alert alert-primary" role="alert">
        {{session('thongbao')}}
    </div>
@endif
    <div class="row">
       
        @include('pages.menu')
        
        <div class="col-md-10">
            <div class="title-index-parent">
                <h2 class="title-index">THÔNG TIN CÁ NHÂN</h2>
            </div>
            <form action="profile" method="post">
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="name" value="{{$infor->name}}" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                <input type="email" value="{{$infor->email}}" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="changepassword" value="checkedValue">
                        Change Password
                    </label>
                </div>
                <div class="form-group">
                    <label for="">Password mới</label>
                    <input type="password" name="password" class="form-control password" 
                    disabled="disabled" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Nhập lại password mới</label>
                    <input type="password" name="repassword" class="form-control password" 
                    disabled="disabled" placeholder="" aria-describedby="helpId">
                </div>
                <button type="submit" class="btn btn-success">UPDATE</button>
                @csrf
            </form>
           
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
    $(document).ready(function () {
        $('#changepassword').change(function () { 
            if($(this).is(":checked")){
                $('.password').removeAttr('disabled');
            }else{
                $('.password').attr('disabled','');
            }
        });
    });
    </script>
@endsection