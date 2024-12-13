@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.permissions')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.permissions')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.permissions') <small>{{ $roles->count() }}</small></h3>
                <form action="{{ route('roles.index') }}" method="get">

                <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                        @can('create_role')    
                            <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>                 
                        @endcan
                    </div>
                </div>
                </form><!-- end of form -->
            </div>
            <div class="box-body">
                @if ($roles->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        @foreach ($roles as $index => $role)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$role->name}}</td>
                                <td>

                                    @can('update_role')
                                        <a href="{{route('roles.edit', $role->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                    @endcan
                                
                                    @can('delete_role')
                                        <form action="{{route('roles.destroy', $role->id)}}" method="POST"
                                            style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        </form>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    {{$roles->appends(request()->query())->links()}}
                @else
                    <h2>@lang('site.no_data_found')</h2>
                @endif

            </div>
        </div>

    </section>

</div>
@endsection