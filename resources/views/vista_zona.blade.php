<section class="content-header clearfix">
    <h1>
        Campeonatos
        <small>Seleccione una opción</small>
    </h1>
</section>

{{-- Selector de Campeonatos --}}
<div class="row">
    <div class="col">
        <select class="form-select form-select-lm mb-3" id="campeonatoSelect" name="campeonatoSelect">
            @foreach($campeonatos as $campeonato)
            <option value="{{ $campeonato->id }}">{{ $campeonato->nombre }}</option> {{-- Cambia aquí --}}
            @endforeach
        </select>
    </div>

    <div class="col"></div>

</div>

<div class="row row-cols-1 row-cols-md-2 g-4" id="sorteosContenedor">
    {{-- Este contenedor será llenado dinámicamente con JavaScript --}}
</div>
