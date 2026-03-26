@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Dodavanje vozila</h4>
                </div>

                <div class="card-body">

                    {{-- Poruka o uspehu --}}
                    @if(session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif

                    {{-- Forma --}}
                    <form action="{{ route('home.storeVehicle') }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf

                        {{-- Naziv --}}
                        <div class="mb-3">
                            <label class="form-label">Naziv vozila</label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
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
                                placeholder="Kratak opis vozila">{{ old('description') }}</textarea>

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
                                value="{{ old('price_per_day') }}"
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
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                            <label class="form-label">Slika proizvoda</label>
                            <input 
                                type="file" 
                                name="image"
                                class="form-control @error('image') is-invalid @enderror">

                            <small class="text-muted">
                                Dozvoljeni formati: JPG, PNG (max 2MB)
                            </small>

                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Dugmad --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                ← Nazad na dashboard
                            </a>

                            <button type="submit" class="btn btn-primary px-4">
                                Sačuvaj vozilo
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
