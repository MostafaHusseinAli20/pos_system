@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.categories')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li><i class="fa fa-dashboard"></i> @lang('site.categories')</li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.add')</li>
        </ol>

    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add_category') </h3>
            </div>

            <div class="box-body">

                @include('partials._errors')

                <form action="{{route('categories.store')}}" method="POST">

                    @csrf
                    @method('post')

                    @foreach (config('translatable.locales') as $locale)
                        <div class="form-group">
                            <label for="">@lang('site.'. $locale . '.name')</label>
                            <input class="form-control" type="text" name="{{ $locale }}[name]" value="{{ old($locale . '.name') }}" required>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>
                </form>
            </div>
        </div>

    </section>

</div>
@endsection