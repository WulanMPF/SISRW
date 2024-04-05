<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Selamat Datang, Ketua RW</h1> 
                <p>{{ date('l, d F Y') }}</p>
                <button onclick="history.go(-1)" class="btn btn-back">Back</button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach ($breadcrumb->list as $key => $value)
                        @if ($key == count($breadcrumb->list) - 1)
                            <li class="breadcrumb-item active">{{ $value }}</li>
                        @else
                            <li class="breadcrumb-item">{{ $value }}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>

<style>
    .btn-back {
        background-color: transparent;
        border: 2px solid #463720;
        color: #463720;
        border-radius: 10px;
        padding: 8px 20px;
        transition: background-color 0.3s ease;
    }

    .btn-back:hover {
        background-color: #463720;
        color: #ffffff;
    }

    .btn-back:active {
        background-color: #ffffff;
        color: #463720;
    }
</style>
