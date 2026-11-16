{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@parent

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-plus"></i> Land Owner View
                                <span class="pr-2 float-right">
                                     <a class="btn btn-sm btn-primary" href="{{url('/admin/land-owner')}}">Land Owner List</a>
                                </span>
                            </h3>
                        </div>
                        <div class="card-body">
                              <div class="form-group row">
                                   <label class="col-md-4"><strong>Name Of The Landowner <span class="float-right">:</span></strong></label>
                                   <div class="col-md-8">{{$row->name_of_landowner??'--'}}</div>
                              </div>
                              <div class="form-group row">
                                     <label class="col-md-4"><strong>Contact Person <span class="float-right">:</span></strong></label>
                                     <div class="col-md-8">{{$row->contact_person??'--'}}</div>
                                </div>
                              <div class="form-group row">
                                   <label class="col-md-4"><strong>Email <span class="float-right">:</span></strong></label>
                                   <div class="col-md-8">{{$row->user_email??'--'}}</div>
                              </div>
                              <div class="form-group row">
                                     <label class="col-md-4"><strong>Mobile Number<span class="float-right">:</span></strong></label>
                                     <div class="col-md-8">{{$row->mobile_number??'--'}}</div>
                                </div>

                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Address <span class="float-right">:</span></strong></label>
                                     <div class="col-md-8">{{$row->address??'--'}}</div>
                                </div>
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Land Address <span class="float-right">:</span></strong></label>
                                     <div class="col-md-8">{{$row->land_address??'--'}}</div>
                                </div>
                                @if($row->area_of_plot)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Size/Area Of The Plot (In Katha) <span class="float-right">:</span></strong></label>
                                     <div class="col-md-8">{{$row->area_of_plot??'--'}}</div>
                                </div>
                                @endif
                                @if($row->plot_dimension_in_front)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Plot Dimension, Frontage Along Road (In Feet) <span class="float-right">:</span></strong></label>
                                     <div class="col-md-8">{{$row->plot_dimension_in_front??'--'}}</div>
                                </div>
                                @endif

                                @if($row->plot_dimension_in_depth)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Plot Dimension, Depth (In Feet) <span class="float-right">:</span> </strong></label>
                                     <div class="col-md-8">{{$row->plot_dimension_in_depth??'--'}}</div>
                                </div>
                                @endif
                                @if($row->width_of_road)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Width Of Road, In Front Of Plot <span class="float-right">:</span> </strong></label>
                                     <div class="col-md-8">{{$row->width_of_road??'--'}}</div>
                                </div>
                                @endif
                                @if($row->special_feature)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Special Feature <span class="float-right">:</span> </strong></label>
                                     <div class="col-md-8">{{$row->special_feature??'--'}}</div>
                                </div>
                                @endif
                                @if($row->type_of_use)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Type Of Use <span class="float-right">:</span> </strong></label>
                                     <div class="col-md-8">{{$row->type_of_use??'--'}}</div>
                                </div>
                                @endif

                                @if($row->any_special_requirement)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Any Special Features (Corner Plot, Lake, Park Etc.) <span class="float-right">:</span> </strong></label>
                                     <div class="col-md-8">{{$row->any_special_requirement??'--'}}</div>
                                </div>
                                @endif
                                @if($row->remarks)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Remarks <span class="float-right">:</span> </strong></label>
                                     <div class="col-md-8">{{$row->remarks??'--'}}</div>
                                </div>
                                @endif
                                @if($row->created_at)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Submitted Date <span class="float-right">:</span> </strong></label>
                                     <div class="col-md-8">{{$row->created_at??'--'}}</div>
                                </div>
                                @endif

                                
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
