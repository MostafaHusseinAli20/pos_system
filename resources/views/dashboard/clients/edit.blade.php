@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.clients')</h1>

        <ol class="breadcrumb">
            <li ><i class="fa fa-dashboard"></i> 
                <a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
            <li><i class="fa fa-dashboard"></i> @lang('site.clients')</li>
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.update')</li>
        </ol>

    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.edit_client') </h3>
            </div>

            <div class="box-body">

                @include('partials._errors')

                    <form action="{{route('clients.update', $client->id)}}" method="POST">

                        @csrf
                        @method('put')
    
                            <div class="form-group">
                                <label for="">@lang('site.name')</label>
                                <input class="form-control" type="text" name="name" value="{{$client->name}}">
                            </div>

                            @for ($i = 0; $i < 2; $i++)
                                <div class="form-group">
                                    <label for="">@lang('site.phone')</label>
                                    <input class="form-control" type="text" name="phone[]" value="{{$client->phone[$i] ?? ''}}">
                                </div>
                            @endfor

                            <div class="form-group">
                                <label for="">@lang('site.address')</label>
                                <input class="form-control" type="text" name="address" value="{{$client->address}}">
                            </div>
    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.edit')</button>
                        </div>
                    </form>
                
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