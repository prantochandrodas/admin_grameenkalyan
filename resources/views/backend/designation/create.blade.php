{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@parent

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @include('common.msg')
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-Name"><i class="fa fa-plus"></i> Designation Create Form
                                <span class="pr-2 float-right">
                                     <a class="btn btn-sm btn-primary" href="{{url('/admin/designation')}}">Designation List</a>
                                </span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/designation') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Name <span class="text-danger"> *</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                        <small class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-10 offset-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            Create
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
@section('scripts')
@parent
<script src="/js/hummingbird-treeview.js"></script>
<script>
    $(document).ready(function () {
        $("#treeview").hummingbird();

        /*
         *  prevent multiple form submit
         */
        $("#btnSubmit").on('click', function (event) {
            event.preventDefault();
            var el = $(this);
            el.prop('disabled', true);
            $('#createform').submit();
            setTimeout(function(){el.prop('disabled', false); }, 3000);
        });
    });
    CKEDITOR.replace( 'description' );


</script>
@endsection
