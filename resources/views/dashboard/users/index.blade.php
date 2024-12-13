@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.users')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.users') <small>{{ $users->count() }}</small></h3>
                <form action="{{ route('users.index') }}" method="get">

                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                        </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                        @can('create_user')
                                    <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>                        
                        @endcan
                    </div>

                    </div>
                </form><!-- end of form -->
            </div>

            <div class="box-body">
                @if ($users->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.first_name')</th>
                            <th>@lang('site.last_name')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.status')</th>
							<th>@lang('site.user_type')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->status == 'active')
                                        <span class="label text-success d-flex">
                                            <span style="color: black">{{ $user->status }}</span>
                                            <div class="dot-label bg-success"></div>
                                        </span>
                                    @else
                                        <span class="label text-danger d-flex">
                                            <span style="color: black">{{ $user->status }}</span>
                                            <div class="dot-labelDanger bg-success"></div>                                            
                                        </span>
                                    @endif
                                </td>

                                <td>

                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                        @endforeach
                                    @endif

                                </td>

                                <td>
                                    @can('update_user')
                                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                    @endcan

                                    @can('delete_user')
                                        <form action="{{route('users.destroy', $user->id)}}" method="POST"
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

                    {{$users->appends(request()->query())->links()}}

                @else
                    <h2>@lang('site.no_data_found')</h2>
                @endif

            </div>
        </div>

    </section>

</div>
@endsection