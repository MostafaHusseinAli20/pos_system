@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.categories')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.categories')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.categories') <small>{{ $categories->count() }}</small></h3>
                <form action="{{ route('categories.index') }}" method="get">

                    <div class="row">

                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                    </div>
                    <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                        @can('create_category')
                            <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>                        
                        @endcan
                    </div>

                    </div>
                </form><!-- end of form -->
            </div>

            <div class="box-body">
                @if ($categories->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.products_count')</th>
                            <th>@lang('site.related_products')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->products->count() }}</td>
                                <td><a href="{{route('products.index', ['category_id' => $category->id])}}" class="btn btn-info btn-sm">@lang('site.related_products')</a></td>
                                <td>
                                     @can('update_category')
                                        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> @lang('site.edit')</a>     
                                     @endcan

                                    @can('delete_category')
                                        <form action="{{route('categories.destroy', $category->id)}}" method="POST"
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

                    {{$categories->appends(request()->query())->links()}}

                @else
                    <h2>@lang('site.no_data_found')</h2>
                @endif

            </div>
        </div>

    </section>

</div>
@endsection