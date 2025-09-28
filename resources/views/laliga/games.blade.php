@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-futbol me-2"></i>
                        Mecze FC Barcelony
                    </h3>
                </div>
                <div class="card-body">
                    @livewire('matches-table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
