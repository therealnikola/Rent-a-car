@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Zahtevi za iznajmljivanje</h1>

    @foreach($requests as $req)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Korisnik:</strong> {{ optional($req->sender)->name }}</p>
                <p><strong>Oprema:</strong> {{ optional($req->vehicle)->name ?? 'Obrisana oprema' }}</p>
                <p><strong>Poruka:</strong> {{ $req->text ?? '-' }}</p>
                    <p>
                <strong>Status:</strong>
                <span class="badge bg-secondary">{{ $req->status }}</span>
                    </p>


                @if($req->status === 'pending')
                    <a href="{{ route('home.updateRequest', [$req->id, 'accepted']) }}"
                       class="btn btn-success btn-sm">Prihvati</a>

                    <a href="{{ route('home.updateRequest', [$req->id, 'rejected']) }}"
                       class="btn btn-danger btn-sm">Odbij</a>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
