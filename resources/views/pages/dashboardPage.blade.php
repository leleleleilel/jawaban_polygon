@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/dashboard') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span class="ml-2">Dashboard</span>
                            </a>
                        </li>
                        @if (auth()->user()->role == 'bapak')
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ url('/transaction') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="13 2 13 9 20 9"></polyline>
                                    </svg>
                                    <span class="ml-2">Transaction</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <h1 class="h2">Dashboard</h1>
                @if (auth()->user()->role == 'bapak')
                    <div class="row my-4">
                        <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                            <div class="card">
                                <h5 class="card-header">Saldo</h5>
                                <div class="card-body">
                                    <h5 class="card-title">{{ auth()->user()->saldo }}</h5>

                                </div>
                            </div>
                        </div>
                        @foreach ($category as $item)
                            <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <div class="card">
                                    <h5 class="card-header">{{ $item->nama }}</h5>
                                    <div class="card-body">
                                        @php

                                        @endphp
                                        <h5 class="card-title">Pemasukan:
                                            {{ DB::table('transactions')->where('kategori_id', $item->id)->where('jenis_transaksi','pemasukan')->whereBetween('tanggal_transaksi', [$startDate, $endDate])->sum('nominal') }}
                                        </h5>
                                        <h5 class="card-title">Pengeluaran:
                                            {{ DB::table('transactions')->where('kategori_id', $item->id)->where('jenis_transaksi','pengeluaran')->whereBetween('tanggal_transaksi', [$startDate, $endDate])->sum('nominal') }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Jenis Transaksi</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->tanggal_transaksi }}</td>
                                        <td>{{ DB::table('categories')->where('id', $item->kategori_id)->first()->nama }}
                                        </td>
                                        <td>{{ $item->nominal }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->jenis_transaksi }}</td>
                                        <td>{{ $item->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Jenis Transaksi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->tanggal_transaksi }}</td>
                                        <td>{{ DB::table('categories')->where('id', $item->kategori_id)->first()->nama }}
                                        </td>
                                        <td>{{ $item->nominal }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->jenis_transaksi }}</td>
                                        <td>{{ $item->status }}</td>
                                        @if ($item->status == 'pending')
                                            <td><a href="{{ url("/confirm/{$item->id}") }}"><button>Konfirmasi</button></a>
                                            </td>
                                            <td><a
                                                    href="{{ url("/transaction/edit/{$item->id}") }}"><button>Edit</button></a>
                                            </td>
                                            <td><a href="{{ url("/delete/{$item->id}") }}"><button>Delete</button></a></td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </main>
        </div>
    </div>
@endsection
