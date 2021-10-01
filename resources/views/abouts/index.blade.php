@extends('base_layout._layout')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-search"></i>@lang('lang.search')</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('aboutus.index')}}" method="GET">
                                <div class="col-sm-4 form-group">
                                    <label for="name">@lang('about.fields.title')</label>
                                    <input type="text" name="title" class="form-control"
                                           value="{{app('request')->get('title')}}">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="description">@lang('about.fields.description')</label>
                                    <input type="text" name="description" class="form-control"
                                           value="{{app('request')->get('description')}}">
                                </div>


                                <div class="form-action col-sm-12 text-right">
                                    <input type="submit" value="{{trans('lang.search')}}" class="btn btn-primary">
                                    <a class="btn btn-default"
                                       href="{{route('aboutus.index')}}">@lang('lang.cancel')</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-book"></i>{{__('about.titles.abouts')}}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                        <tr>
                            <th class="text-center">@lang('about.fields.title')</th>
                            <th class="text-center">@lang('about.fields.description')</th>
                            <th style="text-align: center" class="text-center">@lang('lang.options')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $about)
                            <tr>
                                <td class="text-center">{{$about->title}}</td>
                                <td class="text-center">{{\Illuminate\Support\Str::limit($about->description, 50, '...') }}</td>

                                <td class="text-center">
                                    <a href="{{route('aboutus.edit', $about->about_id)}}" class="btn btn-primary ">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{route('aboutus.show', $about->about_id)}}" class="btn btn-primary ">
                                        <i class="fa fa-eye"></i>
                                    </a>

{{--                                    <a href="{{route('about.destroy', $about->about_id)}}" class="btn btn-danger " >--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </a>--}}
                                    <a href="{{route('about.delete', $about->about_id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="com-md-12 text-right">
                        {{$items->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection

