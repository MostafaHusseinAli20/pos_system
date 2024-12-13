@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.categories')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li><i class="fa fa-dashboard"></i> @lang('site.categories')</li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.update')</li>
        </ol>

    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.edit_category') </h3>
            </div>

            <div class="box-body">

                @include('partials._errors')

                    <form action="{{route('categories.update', $category->id)}}" method="POST">

                        @csrf
                        @method('put')
    
                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label for="">@lang('site.'. $locale . '.name')</label>
                                <input class="form-control" type="text" name="{{ $locale }}[name]" value="{{ $category->translate($locale)->name}}" required>
                            </div>
                        @endforeach
    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.edit')</button>
                        </div>
                    </form>
                
            </div>
        </div>

    </section>

</div>


<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection