@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li><i class="fa fa-dashboard"></i> @lang('site.users')</li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.update')</li>
        </ol>

    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.edit_user') </h3>
            </div>

            <div class="box-body">

                @include('partials._errors')

                    @csrf
                    @method('put')

                    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                    
                            <div class="mg-t-20 mg-md-t-0" style="margin-bottom: 1%;">
                                <label> @lang('site.first_name')</label>
                                {!! Form::text('first_name', null, array('class' => 'form-control','required')) !!}
                            </div>
                            
                            <div class="mg-t-20 mg-md-t-0" style="margin-bottom: 1%;">
                                <label> @lang('site.last_name')</label>
                                {!! Form::text('last_name', null, array('class' => 'form-control','required')) !!}
                            </div>

                            <div class="mg-t-20 mg-md-t-0">
                                <label>@lang('site.email')</label>
                                {!! Form::text('email', null, array('class' => 'form-control','required')) !!}
                            </div> <br>
                 
                            <div class="mg-t-20 mg-md-t-0">
                                <label>@lang('site.password')</label>
                                {!! Form::password('password', array('class' => 'form-control','required')) !!}
                            </div> <br>

                            <label class="form-label">@lang('site.status')</label> <br>
                            <select name="status" id="select-beast" class="form-control  nice-select  custom-select">
                                <option value="{{$user->status}}" selected disabled>@lang('site.choose_status')</option>
                                <option value="active">@lang('site.active')</option>
                                <option value="pending">@lang('site.pending')</option>
                            </select> <br>

                            <div class="form-group">
                                <strong>@lang('site.user_type')</strong>
                                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple'))
                                !!}
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.update')</button>
                            </div>
                    {!! Form::close() !!}
                
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