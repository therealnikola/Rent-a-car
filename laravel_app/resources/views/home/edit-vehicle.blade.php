@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Izmena vozila: {{ $vehicle->name }}</h4>
                </div>

                <div class="card-body">

                    {{-- Poruka o uspehu --}}
                    @if(session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif

                    {{-- Forma za UPDATE --}}
                    <form action="{{ route('home.updateVehicle', $vehicle->id) }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Ovo govori Laravelu da radi update --}}

                        {{-- Naziv --}}
                        <div class="mb-3">
                            <label class="form-label">Naziv vozila</label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $vehicle->name) }}"
                                placeholder="Unesite naziv vozila">
                            
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Opis --}}
                        <div class="mb-3">
                            <label class="form-label">Opis vozila</label>
                            <textarea 
                                name="description" 
                                rows="4"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Kratak opis vozila">{{ old('description', $vehicle->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Cena --}}
                        <div class="mb-3">
                            <label class="form-label">Cena po danu (RSD)</label>
                            <input 
                                type="number" 
                                name="price_per_day" 
                                class="form-control @error('price_per_day') is-invalid @enderror"
                                value="{{ old('price_per_day', $vehicle->price_per_day) }}"
                                placeholder="npr. 1500">

                            @error('price_per_day')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kategorija --}}
                        <div class="mb-3">
                            <label class="form-label">Kategorija</label>
                            <select 
                                name="category_id" 
                                class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- Izaberite kategoriju --</option>
                                @foreach($categories as $category)
                                    <option 
                                        value="{{ $category->id }}"
                                        {{ old('category_id', $vehicle->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- SLIKA --}}
                        <div class="mb-4">
                            <label class="form-label">Promeni sliku (opciono)</label>
                            <input 
                                type="file" 
                                name="image"
                                class="form-control @error('image') is-invalid @enderror">

                            @if($vehicle->image)
                                <div class="mt-2">
                                    <small class="text-muted d-block mb-1">Trenutna slika:</small>
                                    <img src="{{ asset('vehicle_images/'.$vehicle->image) }}" alt="Slika" style="height: 100px; border-radius: 5px; border: 1px solid #ddd;">
                                </div>
                            @endif

                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Dugmad --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                ← Odustani
                            </a>

                            <button type="submit" class="btn btn-success px-4">
                                <i class="fa fa-save"></i> Sačuvaj izmene
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection