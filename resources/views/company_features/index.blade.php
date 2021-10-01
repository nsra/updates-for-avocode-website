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
                            <form action="{{route('company_features.index')}}" method="GET">
                                <div class="col-sm-4 form-group">
                                    <label for="name">@lang('company_feature.fields.title')</label>
                                    <input type="text" name="title" class="form-control"
                                           value="{{app('request')->get('title')}}">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="description">@lang('company_feature.fields.description')</label>
                                    <input type="text" name="description" class="form-control"
                                           value="{{app('request')->get('description')}}">
                                </div>


                                <div class="form-action col-sm-12 text-right">
                                    <input type="submit" value="{{trans('lang.search')}}" class="btn btn-primary">
                                    <a class="btn btn-default"
                                       href="{{route('company_features.index')}}">@lang('lang.cancel')</a>
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
                    <h3 class="panel-title"><i class="fa fa-book"></i>{{__('company_feature.titles.company_features')}}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                        <tr>
                            <th class="text-center">@lang('company_feature.fields.title')</th>
                            <th class="text-center">@lang('company_feature.fields.description')</th>
                            <th style="text-align: center" class="text-center">@lang('lang.options')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $company_feature)
                            <tr>
                                <td class="text-center">{{$company_feature->title}}</td>
                                <td class="text-center">{{\Illuminate\Support\Str::limit($company_feature->description, 50, '...') }}</td>

                                <td class="text-center">
                                    <a href="{{route('company_features.edit', $company_feature->company_feature_id)}}" class="btn btn-primary ">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{route('company_features.show', $company_feature->company_feature_id)}}" class="btn btn-primary ">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a class="btn btn-danger delete-company_feature" data-value="{{$company_feature->company_feature_id}}">
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
        $('.delete-company_feature').click(function () {
            var id = $(this).data('value')
            swal({
                    title: "@lang('lang.questions.confirm_remove')",
                    text: "@lang('company_feature.questions.do_remove')",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "@lang('lang.yes')",
                    cancelButtonText: "@lang('lang.no')",
                    closeOnConfirm: false
                },
                function () {
                    /**
                     *
                     * send ajax request for deleting company_feature
                     *
                     */
                    $.ajax({
                        url: '{{route('company_feature.destroy')}}/' + id,
                        method: 'GET',
                        {{--url: "{{url('/destroy')}}",--}}
                        data: {body: '', _token: '{{csrf_token()}}'}
                    }).success(function (response) {
                        if (response.status == 200) {
                            swal("@lang('lang.alert')", response.message, "success")
                            window.location.reload()
                        } else {
                            swal("@lang('lang.alert')", response.message, "error")
                        }
                    })
                });
        })
    </script>
@endsection

