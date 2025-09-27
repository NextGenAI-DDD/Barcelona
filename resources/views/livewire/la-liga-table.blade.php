<div wire:poll.60s="loadStandings">
    <h3 class="mb-3">Tabela La Liga</h3>

    <table class="table table-hover table-bordered align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Drużyna</th>
                <th>M</th>
                <th>W</th>
                <th>R</th>
                <th>P</th>
                <th>BZ</th>
                <th>BS</th>
                <th>+/-</th>
                <th>Pkt</th>
                <th>Forma</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($standings as $team)
                <tr
                    class="@if ($team->team === $highlightTeam) table-primary fw-bold @endif animate__animated animate__fadeIn"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Ostatnie mecze: {{ $team->form }}"
                >
                    <td>{{ $team->rank }}</td>
                    <td class="text-start">
                        <img src="{{ $team->logo }}" alt="logo" width="24" class="me-2">
                        {{ $team->team }}
                    </td>
                    <td>{{ $team->match_played }}</td>
                    <td>{{ $team->win }}</td>
                    <td>{{ $team->draw }}</td>
                    <td>{{ $team->lose }}</td>
                    <td>{{ $team->goals_for }}</td>
                    <td>{{ $team->goals_against }}</td>
                    <td>{{ $team->goals_diff }}</td>
                    <td class="fw-bold">{{ $team->points }}</td>
                    <td>{{ $team->form }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Loading --}}
    <div wire:loading>
        <div class="alert alert-info">Odświeżanie tabeli...</div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("livewire:navigated", () => {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })
</script>
@endpush

