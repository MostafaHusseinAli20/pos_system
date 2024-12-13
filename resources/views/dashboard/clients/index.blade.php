@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.clients')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.clients')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.clients') <small>{{ $clients->count() }}</small></h3>
                <form action="{{ route('clients.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                        </div>
                    <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                        @can('create_client')    
                            <a href="{{ route('clients.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>                        
                        @endcan
                    </div>

                    </div>
                </form><!-- end of form -->
            </div>

            <div class="box-body">
                @if ($clients->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.phone')</th>
                            <th>@lang('site.address')</th>
                            <th>@lang('site.add_order')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($clients as $index => $client)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ implode('-', array_filter($client->phone)) }}</td>
                                <td>{{ $client->address }}</td>

                                <td>
                                    
                                    @can('create_order')
                                        <a href="{{ route('clients.orders.create', $client->id )}}" class="btn btn-warning btn-sm">@lang('site.add_order')</a>
                                    @endcan
                                </td>

                                <td>
                                    
                                     @can('update_client')
                                        <a href="{{route('clients.edit', $client->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                     @endcan

                                    @can('delete_client')
                                        <form action="{{route('clients.destroy', $client->id)}}" method="POST"
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

                    {{$clients->appends(request()->query())->links()}}

                @else
                    <h2>@lang('site.no_data_found')</h2>
                @endif

            </div>
        </div>

    </section>

</div>
@endsection