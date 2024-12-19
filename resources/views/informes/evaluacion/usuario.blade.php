@extends('layout')

@section('seccion', 'Teleoperador')
@section('title', 'Evaluar Usuario')
@section('ruta_volver', route('evaluar.index'))
@section('content')
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form class="beneficiary-form" method="post"  action="{{route('evaluar.usuario.store')}}"enctype="multipart/form-data">
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
                <label for="email_teleoperador">Email del Teleoperador</label>
                <input type="text" id="email_teleoperador" name="email_teleoperador" placeholder="Nombre del teleoperador" value="{{Auth::user()->email}}" required readonly/>
            </div>
            <div class="form-group">
                <label for="email_usuario">Email del Usuario</label>
                <input type="text" id="email_usuario" name="email_usuario" placeholder="Nombre del usuario" required />
            </div>
            <h3>Creatividad del Caso</h3>
            <div class="form-group">
                <label for="creatividad">El caso planteado por el usuario/a es muy creativo y entendible:</label>
                <input type="number" id="creatividad" name="creatividad" min="1" max="10" required placeholder="Minimo 1, Maximo 10">
            </div>
            <h3>Satisfacción del Usuario</h3>
            <div class="form-group">
                <label for="satisfaccion_usuario">El teleoperador constata que la persona usuaria ha quedado completamente satisfecha:</label>
                <input type="number" id="satisfaccion_usuario" name="satisfaccion_usuario" min="1" max="10" required placeholder="Minimo 1, Maximo 10">
            </div>
            <h3>Satisfacción del Teleoperador</h3>
            <div class="form-group">
                <label for="satisfaccion_teleoperador">El usuario respeta las normas de uso del servicio y trata con educación al profesional:</label>
                <input type="number" id="satisfaccion_teleoperador" name="satisfaccion_teleoperador" min="1" max="10" required placeholder="Minimo 1, Maximo 10">
            </div>
            <h3>Habilidades de Teatralización</h3>
            <div class="form-group">
                <label for="teatralizacion">El usuario/a escenifica la edad, situación de salud o necesidad, personalidad, etc:</label>
                <input type="number" id="teatralizacion" name="teatralizacion" min="1" max="10" required placeholder="Minimo 1, Maximo 10">
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
