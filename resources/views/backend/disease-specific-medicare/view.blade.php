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
                            <h3 class="card-title"><i class="fa fa-plus"></i> SBDC View
                                <span class="pr-2 float-right">
                                     <a class="btn btn-sm btn-primary" href="{{url('/admin/sfdc')}}">SBDC List</a>
                                </span>
                            </h3>
                        </div>
                        <div class="card-body">
                              <div class="form-group row">
                                   <label class="col-md-4"><strong>Name of Business <span class="float-right">:</span></strong></label>
                                   <div class="col-md-8">{{$row->name_of_business??'--'}}</div>
                              </div>
                              <div class="form-group row">
                                     <label class="col-md-4"><strong>Vision <span class="float-right">:</span></strong></label>
                                     <div class="col-md-8">{{$row->vision??'--'}}</div>
                                </div>
                              <div class="form-group row">
                                   <label class="col-md-4"><strong>Initiative Plan <span class="float-right">:</span></strong></label>
                                   <div class="col-md-8">{{$row->initiative_plan??'--'}}</div>
                              </div>
                              <div class="form-group row">
                                     <label class="col-md-4"><strong>Founder Type <span class="float-right">:</span></strong></label>
                                     <div class="col-md-8">{{$row->founder_type??'--'}}</div>
                                </div>

                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Focus Area <span class="float-right">:</span></strong></label>
                                     <div class="col-md-8">{{$row->focus_area??'--'}}</div>
                                </div>
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Social Problems <span class="float-right">:</span></strong></label>
                                     <div class="col-md-8">{{$row->social_problems??'--'}}</div>
                                </div>
                                @if($row->other_focus_area)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Other Focus Area <span class="float-right">:</span></strong></label>
                                     <div class="col-md-8">{{$row->other_focus_area??'--'}}</div>
                                </div>
                                @endif
                                @if($row->reducing_carbon_emission)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Reducing Carbon Emission <span class="float-right">:</span></strong></label>
                                     <div class="col-md-8">{{$row->reducing_carbon_emission??'--'}}</div>
                                </div>
                                @endif

                                @if($row->innovation)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Innovation <span class="float-right">:</span> </strong></label>
                                     <div class="col-md-8">{{$row->innovation??'--'}}</div>
                                </div>
                                @endif
                                @if($row->info_enterprise)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Info of Enterprise <span class="float-right">:</span> </strong></label>
                                     <div class="col-md-8">{{$row->info_enterprise??'--'}}</div>
                                </div>
                                @endif
                                @if($row->stage_of_ventures)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Stage of Ventures <span class="float-right">:</span> </strong></label>
                                     <div class="col-md-8">{{$row->stage_of_ventures??'--'}}</div>
                                </div>
                                @endif

                                @if($row->is_way_of_more_to_learn)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Way of More To Learn <span class="float-right">:</span> </strong></label>
                                     <div class="col-md-8">{{$row->way_of_more_to_learn??'--'}}</div>
                                </div>
                                @endif
                                @if($row->pitch_deck)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Pitch Deck <span class="float-right">:</span> </strong></label>
                                     @if($row->pitch_deck)
                                      <a class="btn btn-success" href="/{{$row->pitch_deck}}" download>Download</a>
                                     @endif
                                </div>
                                @endif
                                @if($row->created_at)
                                <div class="form-group row">
                                     <label class="col-md-4"><strong>Submitted Date <span class="float-right">:</span> </strong></label>
                                     <div class="col-md-8">{{date('d-m-Y', strtotime($row->created_at))??'--'}}</div>
                                </div>
                                @endif
                                @if($row->is_registered_under_law)
                                <div class="form-group row pl-5">
                                     <input type="checkbox" @if($row->is_registered_under_law) checked @endif>
                                     <label class="col-md-4"><strong>Is Registered Under Law  </strong></label>
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
