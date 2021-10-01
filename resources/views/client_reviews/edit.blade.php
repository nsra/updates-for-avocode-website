@extends('base_layout._layout')

@section('body')
    <div class="row">

        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('lang.edit_client_review') }}</h3>

                </div>
                <div class="card-body">
                    <form action="{{route('client_reviews.update', $client_review->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group " style="text-align: center">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                    <img src="{{$client_review->getImage()}}" alt="">
                                </div>
                                <div>
                                    <span class="btn red btn-outline btn-file">
                                    <span class="fileinput-new"> {{__('lang.select_image')}} </span>
                                    <span class="fileinput-exists"> {{__('lang.change')}} </span>
                                    <input type="file" name="client_review_image"> </span>
                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{__('lang.remove')}} </a>
                                    <span class="error col-md-12">{{$errors->first('client_review_image')}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="en_name">{{__('lang.en_name')}} <span class="required">*</span></label>
                            <input type="text" class="form-control" name="en_name" value="{{old('en_name', optional($client_review->translate('en'))->name) }}">
                            <span class="error">{{$errors->first('en_name')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="ar_name">{{__('lang.ar_name')}} <span class="required">*</span></label>
                            <input type="text" class="form-control" name="ar_name" value="{{old('ar_name', optional($client_review->translate('ar'))->name) }}">
                            <span class="error">{{$errors->first('ar_name')}}</span>
                        </div>


                        <div class="form-group">
                            <label for="en_review">{{__('lang.client_review_review_en')}} <span class="required">*</span></label>
                            <textarea type="text" class="form-control" name="en_review" >{{ old('en_review', optional($client_review->translate('en'))->review) }}</textarea>
                            <span class="error">{{$errors->first('en_review')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="ar_review">{{__('lang.client_review_review_ar')}} <span class="required">*</span></label>
                            <textarea type="text" class="form-control" name="ar_review" >{{ old('ar_review', optional($client_review->translate('ar'))->review) }}</textarea>
                            <span class="error">{{$errors->first('ar_review')}}</span>
                        </div>



                </div>


                <div class="form-action text-center">
                    <button type="submit"  class="btn btn-primary">@lang('lang.edit')</button>
                    <button href="{{route('client_reviews.index')}}" type="reset"
                            class="btn btn-default">@lang('lang.cancel')</button>
                </div>
            </div>
            </form>
            <br>
            <br>
        </div>
    </div>
    </div>
    </div>


@endsection

