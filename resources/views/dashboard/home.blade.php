@extends('layout.master')

@section('main-content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.dashboard')</h1>

        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            {{-- categories--}}
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $catigories_count }}</h3>

                        <p>@lang('site.categories')</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('categories.index')}}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            {{--products--}}
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $products_count }}</h3>

                        <p>@lang('site.products')</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('products.index')}}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            {{--clients--}}
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $clients_count }}</h3>

                        <p>@lang('site.clients')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="{{route('clients.index')}}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            {{--users--}}
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $users_count }}</h3>

                        <p>@lang('site.users')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{route('users.index')}}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div><!-- end of row -->

        <div class="box box-solid">

            <div class="box-header">
                <h3 class="box-title">Sales Graph</h3>
            </div>
            <div class="box-body border-radius-none">
                
                <div>
                    <?= $chart->toHtml('my_chart'); ?>
                </div>
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
            </div>

        </div>

    </section>

</div>

@endsection

@push('scripts')
    
<script src="{{ asset('dashboard_files/plugins/chart.js/Chart.bundle.min.js')}} "></script>
<script src="{{ asset('dashboard_files/js/chart.flot.sampledata.js')}} "></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = @json($sales_labels);
    const dataValues = @json($sales_data_values);

    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Sales',
                data: dataValues,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 4,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endpush