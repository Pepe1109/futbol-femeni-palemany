<x-mail::message>
# Partits de la Jornada

Aquests són els partits programats per a la pròxima jornada:

@foreach($partits as $partit)
- **{{ $partit->equipLocal->nom }}** vs **{{ $partit->equipVisitant->nom }}** ({{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y H:i') }})
@endforeach

Gràcies,<br>
{{ config('app.name') }}
</x-mail::message>