@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.access')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li><i class="fa fa-dashboard"></i> @lang('site.access')</li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.add')</li>
        </ol>

    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add_access') <small></small></h3>
            </div>

            <div class="box-body">

                @include('partials._errors')

                {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                <div class="form-group">
                    <p>اسم الصلاحية :</p>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                    <div class="row">
                            <ul>
                                @foreach($permissions as $value)
                                    <li>
                                        <label style="font-size: 16px;">
                                            {!! Form::checkbox('permission[]', $value->name, false, ['class' => 'name']) !!}
                                            {{ $value->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>

    </section>

</div>
@endsection