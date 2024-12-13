@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.clients')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li><i class="fa fa-dashboard"></i> @lang('site.clients')</li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.add')</li>
        </ol>

    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add_client') </h3>
            </div>

            <div class="box-body">

                @include('partials._errors')

                <form action="{{route('clients.store')}}" method="POST">

                    @csrf
                    @method('post')

                    <div class="form-group">
                        <label for="">@lang('site.name')</label>
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                    </div>
                    
                    @for ($i = 0; $i < 2; $i++)
                        <div class="form-group">
                            <label for="">@lang('site.phone')</label>
                            <input class="form-control" type="number" name="phone[]">
                        </div>
                    @endfor

                    <div class="form-group">
                        <label for="">@lang('site.address')</label>
                        <textarea class="form-control" type="number" name="address" >{{old('address')}}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>
                </form>
            </div>
        </div>

    </section>

</div>
@endsection