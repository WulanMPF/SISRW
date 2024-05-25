@extends('layout.bendahara.template')
@section('content')
    <ul class="box-info">
        <li class="card">
            <i class="fas fa-solid fa-user"></i>
            <span class="text">
                <h3>1030</h3>
                <p>New Order</p>
            </span>
        </li>
        <li class="card">
            <i class="fas fa-solid fa-user"></i>
            <span class="text">
                <h3>1030</h3>
                <p>New Order</p>
            </span>
        </li>
        <li class="card">
            <i class="fas fa-solid fa-user"></i>
            <span class="text">
                <h3>1030</h3>
                <p>New Order</p>
            </span>
        </li>
        <li class="card">
            <i class="fas fa-solid fa-user"></i>
            <span class="text">
                <h3>1030</h3>
                <p>New Order</p>
            </span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-7 ml-4">
            <div class="card">
                <div class="p-6 m-20 bg-white rounded shadow">
                    {!! $ppChart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-md-4 ml-4">
            <div class="card">
                <div class="p-6 m-20 bg-white rounded shadow">
                    {!! $lapKeuChart->container() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .rounded {
            border-radius: 5rem;
        }

        .box-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 24px;
            margin-top: 36px;
            margin-left: 1rem;
        }

        .box-info li {
            padding: 20px;
            background: var(--light);
            border-radius: 20px;
            display: flex;
            align-items: center;
            grid-gap: 24px;
        }

        .box-info li .bx {
            width: 80px;
            height: 80x;
            border-radius: 10px;
            font-size: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box-info li:nth-child(1) .bx {
            background: lightblue;
            color: blue;
        }
    </style>
@endpush
@push('js')
    <script src="{{ $ppChart->cdn() }}"></script>
    {{ $ppChart->script() }}
    <script src="{{ $lapKeuChart->cdn() }}"></script>
    {{ $lapKeuChart->script() }}
    {{-- <script>
        var options = {
            colors: ['#77B6EA', '#545454'],
            stroke: {
                curve: 'smooth'
            }
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script> --}}
@endpush
