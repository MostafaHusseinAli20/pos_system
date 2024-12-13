@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.permissions')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.permissions')</li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.edit')</li>
        </ol>
    </section>

    <section class="content">
        
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.update_access')</h3>
            </div>
            <div class="box-body">
                {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                    <div class="form-group">
                        <p>@lang('site.access_name')</p>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>

                        <div class="row">
                            <ul>
                                <li>
                                     @foreach($permission as $item)
                                        <label>
                                            {{ Form::checkbox('permission[]', $item->id, in_array($item->id, $rolePermissions), ['class' => 'name']) }}
                                            {{ $item->name }}
                                        </label>
                                        <br />
                                    @endforeach
                                </li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" style="margin-right: 23px;"><i class="fa fa-plus"></i> @lang('site.update')</button>
                        </div>
                    {!! Form::close() !!}

            </div>
        </div>

    </section>

</div>
            
</div>

</div>

@endsection