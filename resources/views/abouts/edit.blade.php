@extends('base_layout._layout')

@section('body')
    <div class="row">

        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('lang.edit_about_us') }}</h3>

                </div>
                <div class="card-body">
                    <form action="{{route('aboutus.update', $about->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group " style="text-align: center">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                    <img src="{{$about->getImage()}}" alt="">
                                </div>
                                <div>
                                    <span class="btn red btn-outline btn-file">
                                    <span class="fileinput-new"> {{__('lang.select_image')}} </span>
                                    <span class="fileinput-exists"> {{__('lang.change')}} </span>
                                    <input type="file" name="about_us_image"> </span>
                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{__('lang.remove')}} </a>
                                    <span class="error col-md-12">{{$errors->first('about_us_image')}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="en_title">{{__('lang.about_us_title_en')}} <span class="required">*</span></label>
                            <input type="text" class="form-control" name="en_title" value="{{ old('en_title', optional($about->translate('en'))->title) }}">
                            <span class="error">{{$errors->first('en_title')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="ar_title">{{__('lang.about_us_title_ar')}} <span class="required">*</span></label>
                            <input type="text" class="form-control" name="ar_title" value="{{ old('ar_title', optional($about->translate('ar'))->title) }}">
                            <span class="error">{{$errors->first('ar_title')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="en_description">{{__('lang.about_us_description_en')}} <span class="required">*</span></label>
                            <textarea type="text" class="form-control" name="en_description" >{{ old('en_description', optional($about->translate('en'))->description) }}</textarea>
                            <span class="error">{{$errors->first('en_description')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="ar_description">{{__('lang.about_us_description_ar')}} <span class="required">*</span></label>
                            <textarea type="text" class="form-control" name="ar_description" >{{ old('ar_description', optional($about->translate('ar'))->description) }}</textarea>
                            <span class="error">{{$errors->first('ar_description')}}</span>
                        </div>

                        <div class="form-action text-center">
                    <button type="submit"  class="btn btn-primary">@lang('lang.edit')</button>
                    <button href="{{route('aboutus.index')}}" type="reset"
                            class="btn btn-default">@lang('lang.cancel')</button>
                </div>

            </form>
            <br>
            <br>
        </div>
    </div>
    </div>
    </div>


@endsection

