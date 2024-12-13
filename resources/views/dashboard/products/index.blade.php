@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.products')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.products')</li>
        </ol>

    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.products') <small>{{ $products->count() }}</small></h3>
                <form action="{{ route('products.index') }}" method="get">
                    @csrf
                    
                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                        </div>

                        <div class="col-md-4">
                            <select name="category_id" class="form-control">
                                <option value="">@lang('site.all_categories')</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                        @can('create_product')
                            <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>                        
                        @endcan
                    </div>

                    </div>
                </form><!-- end of form -->
            </div>

            <div class="box-body">
                @if ($products->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.description')</th>
                            <th>@lang('site.purchase_price')</th>
                            <th>@lang('site.sale_price')</th>
                            <th>@lang('site.stock')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($products as $index => $product)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$product->name}}</td>
                                <td>{!! $product->description !!}</td>
                                <td>{{$product->purchase_price}}</td>
                                <td>{{$product->sale_price}}</td>
                                <td>{{$product->stock}}</td>

                                <td>
                                    @can('update_product')
                                        <a href="{{route('products.edit', $product->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                    @endcan

                                    @can('delete_product')
                                        <form action="{{route('products.destroy', $product->id)}}" method="POST"
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

                    {{$products->appends(request()->query())->links()}}

                @else
                    <h2>@lang('site.no_data_found')</h2>
                @endif

            </div>
        </div>

    </section>

</div>
@endsection