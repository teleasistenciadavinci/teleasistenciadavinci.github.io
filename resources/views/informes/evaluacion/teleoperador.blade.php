@extends('layout')

@section('seccion', 'Usuario')
@section('title', 'Evaluar Teleoperador')
@section('ruta_volver', route('evaluar.index'))
@section('content')
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form class="beneficiary-form" method="post" action="{{route('evaluar.teleoperador.store')}}"  enctype="multipart/form-data">
        @csrf
        <div class="form-grid">

            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" required />
            </div>
            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" id="hora" name="hora" required />
            </div>
            <div class="form-group">
                <label for="email_usuario">Email del Usuario</label>
                <input type="text" id="email_usuario" name="email_usuario" placeholder="Nombre del usuario" value="{{Auth::user()->email}}" required readonly />
            </div>
            <div class="form-group">
                <label for="email_teleoperador">Email del Teleoperador</label>
                <input type="text" id="email_teleoperador" name="email_teleoperador" placeholder="Nombre del teleoperador" required />
            </div>

            <h3>Protocolo de Bienvenida</h3>
            <div class="form-group">
                <label for="bienvenida">El teleoperador/a lleva a cabo el protocolo de bienvenida respetando todos sus elementos:</label>
                <input type="number" id="bienvenida" name="bienvenida" min="1" max="10" required placeholder="Minimo 1, Maximo 10">
            </div>
            <h3>Relación Contenido-Caso</h3>
            <div class="form-group">
                <label for="contenido">La respuesta que ofrece la persona teleoperadora corresponde con la teoría:</label>
                <input type="number" id="contenido" name="contenido" min="1" max="10" required placeholder="Minimo 1, Maximo 10">
            </div>
            <h3>Uso de Estrategias de Comunicación</h3>
            <div class="form-group">
                <label for="comunicacion">El teleoperador/a utiliza las habilidades de escucha activa y de transmisión de información:</label>
                <input type="number" id="comunicacion" name="comunicacion" min="1" max="10" required placeholder="Minimo 1, Maximo 10">
            </div>
            <h3>Protocolo de Despedida</h3>
            <div class="form-group">
                <label for="despedida">El teleoperador/a lleva a cabo el protocolo de despedida respetando todos sus elementos:</label>
                <input type="number" id="despedida" name="despedida" min="1" max="10" required placeholder="Minimo 1, Maximo 10">
            </div>
        </div>
        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea id="observaciones" name="observaciones" rows="4" cols="50"></textarea>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-submit">Enviar Evaluación</button>
        </div>
    </form>
@endsection
