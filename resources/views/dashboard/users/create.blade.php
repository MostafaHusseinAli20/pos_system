@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li><i class="fa fa-dashboard"></i> @lang('site.users')</li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.add')</li>
        </ol>

    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add_user') </h3>
            </div>

            <div class="box-body">

                @include('partials._errors')

                <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('post')

                    <div class="form-group">
                        <label for="">@lang('site.first_name')</label>
                        <input class="form-control" type="text" name="first_name" value="{{old('first_name')}}">
                    </div>

                    <div class="form-group">
                        <label for="">@lang('site.last_name')</label>
                        <input class="form-control" type="text" name="last_name" value="{{old('last_name')}}">
                    </div>

                    <div class="form-group">
                        <label for="">@lang('site.email')</label>
                        <input class="form-control" type="email" name="email" value="{{old('email')}}">
                    </div>

                    {{-- <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input class="form-control" type="file" name="image">
                    </div>

                    <div class="form-group">
                        <img src="{{ asset('uploads/user_images/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                    </div> --}}

                    <div class="form-group">
                        <label for="">@lang('site.password')</label>
                        <input class="form-control" type="password" name="password" value="{{old('password')}}">
                    </div>

                    
                    <label class="form-label">@lang('site.status')</label> <br>
                    <select name="status" id="select-beast" class="form-control  nice-select  custom-select">
                        <option selected disabled>@lang('site.choose_status')</option>
                            <option value="active">@lang('site.active')</option>
                            <option value="pending">@lang('site.pending')</option>
                    </select> <br>
                  
                    <div class="row mg-b-20">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label"> @lang('site.access')</label>
                                    {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                            </div>
                        </div>
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