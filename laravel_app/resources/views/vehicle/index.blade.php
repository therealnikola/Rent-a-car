@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dostupna vozila za iznajmljivanje</h1>

    <div class="row">
        @foreach($vehicle as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    
                    @if($item->image1)
                        <img src="{{ asset('vehicle_images/'.$item->image1) }}" 
                             class="card-img-top"
                             style="height:200px; object-fit:cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text text-muted">
                            {{ $item->price_per_day }} RSD / dan
                        </p>
                        <p>
                            <span class="badge bg-secondary">
                                {{ $item->category->name ?? 'Bez kategorije' }}
                            </span>
                        </p>

                        <a href="{{ route('vehicle.show', $item->id) }}" 
                           class="btn btn-outline-primary w-100">
                            Detalji
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
