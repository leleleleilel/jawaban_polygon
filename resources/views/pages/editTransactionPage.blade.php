@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ url('/dashboard') }}">
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
                <h1 class="h2">Edit Transaction</h1>
                <form method="post" action="{{ url('/transaction/edit',['id'=>$result->id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Transaksi</label>
                        <input name="txttanggaltransaksi" type="date" class="form-control" id=""
                            aria-describedby="" value="{{$result->tanggal_transaksi}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Kategori</label>
                        <select name="optkategori" id="">
                            @forelse ($category as $item)
                                @if ($result->kategori_id==$item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endif
                            @empty
                                <option value="" disabled>Tidak ada kategori</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nominal</label>
                        <input name="txtnominal" type="number" class="form-control" id="" aria-describedby="" value="{{$result->nominal}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Keterangan</label>
                        <input type="text" name="txtketerangan" class="form-control" id="" aria-describedby="" value="{{$result->keterangan}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Kategori</label>
                        <select name="optjenistransaksi" id="">
                            @if ($result->jenis_transaksi=="pemasukan")
                                <option value="pemasukan" selected>Pemasukan</option>
                                <option value="pengeluaran">Pengeluaran</option>
                            @else
                                <option value="pemasukan">Pemasukan</option>
                                <option value="pengeluaran" selected>Pengeluaran</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </main>
        </div>
    </div>
@endsection
