@extends('layout')

@section('seccion', 'Gestión')
@section('title', 'Modificar datos de interés')
@section('ruta_volver', route('gestion.index'))
@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="beneficiary-form" method="post" action="{{ route('gestion.interes.guardar') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
            <div class="form-group">
                <label for="dni_beneficiario">DNI del beneficiario</label>
                <input type="text" id="dni_beneficiario" name="dni_beneficiario" value="{{ $dni }}" placeholder="DNI del beneficiario" required readonly/>
            </div>
            <div class="form-group">
                <label for="enfermedades">Enfermedades (opcional)</label>
                <input type="text" id="enfermedades" name="enfermedades" placeholder="Enfermedades" />
            </div>
            <div class="form-group">
                <label for="alergias">Alergias (opcional)</label>
                <input type="text" id="alergias" name="alergias" placeholder="Alergias" />
            </div>
            <div class="form-group">
                <label for="medicacion_manana">Medicación Mañana (opcional)</label>
                <input type="text" id="medicacion_manana" name="medicacion_manana" placeholder="Medicación Mañana" />
            </div>
            <div class="form-group">
                <label for="medicacion_tarde">Medicación Tarde (opcional)</label>
                <input type="text" id="medicacion_tarde" name="medicacion_tarde" placeholder="Medicación Tarde" />
            </div>
            <div class="form-group">
                <label for="medicacion_noche">Medicación Noche (opcional)</label>
                <input type="text" id="medicacion_noche" name="medicacion_noche" placeholder="Medicación Noche" />
            </div>
            <div class="form-group">
                <label for="hora_preferente_manana">Hora Preferente Mañana</label>
                <input type="time" id="hora_preferente_manana" name="hora_preferente_manana" required />
            </div>
            <div class="form-group">
                <label for="hora_preferente_tarde">Hora Preferente Tarde</label>
                <input type="time" id="hora_preferente_tarde" name="hora_preferente_tarde" required />
            </div>
            <div class="form-group">
                <label for="hora_preferente_noche">Hora Preferente Noche</label>
                <input type="time" id="hora_preferente_noche" name="hora_preferente_noche" required />
            </div>
            <div class="form-group">
                <label for="ambulatorio">¿Servicio de Ambulatorio?</label>
                <select id="ambulatorio" name="ambulatorio" required>
                    <option value="Si">Sí</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ambulancia">¿Servicio de Ambulancia?</label>
                <select id="ambulancia" name="ambulancia" required>
                    <option value="Si">Sí</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="policia">¿Llamar a la Policía?</label>
                <select id="policia" name="policia" required>
                    <option value="Si">Sí</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bomberos">¿Llamar a los Bomberos?</label>
                <select id="bomberos" name="bomberos" required>
                    <option value="Si">Sí</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="urgencias">¿Llamar a Urgencias?</label>
                <select id="urgencias" name="urgencias" required>
                    <option value="Si">Sí</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-submit">Asignar datos de interés</button>
        </div>
        
    </form>
@endsection
