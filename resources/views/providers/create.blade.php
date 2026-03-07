@extends('layouts.app')

@section('content')
<div class="header">
    <h1>Registro de Prestador Turístico</h1>
    <div class="actions">
        <a href="{{ route('providers.index') }}" class="btn btn-outline">Volver al Listado</a>
    </div>
</div>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('providers.store') }}" method="POST">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Número RTN</label>
                <input type="text" name="num_rtn" value="{{ old('num_rtn') }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem;">
                @error('num_rtn') <p style="color: red; font-size: 0.8rem;">{{ $message }}</p> @enderror
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">RIF</label>
                <input type="text" name="rif" value="{{ old('rif') }}" placeholder="J-00000000-0" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem;">
                @error('rif') <p style="color: red; font-size: 0.8rem;">{{ $message }}</p> @enderror
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Razón Social</label>
            <input type="text" name="razon_social" value="{{ old('razon_social') }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem;">
            @error('razon_social') <p style="color: red; font-size: 0.8rem;">{{ $message }}</p> @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Categoría</label>
                <select name="category_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem;">
                    <option value="">Seleccione...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Estado</label>
                <select id="state_selector" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem;">
                    <option value="">Seleccione Estado...</option>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Municipio</label>
            <select name="municipality_id" id="municipality_selector" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem;">
                <option value="">Primero seleccione un estado</option>
            </select>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Dirección Detallada</label>
            <textarea name="direccion" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem; height: 100px;">{{ old('direccion') }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem; padding: 1.5rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--primary);">Estatus RTN</label>
                <select name="status" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem;">
                    <option value="activo" {{ old('status') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="vencido" {{ old('status') == 'vencido' ? 'selected' : '' }}>Vencido</option>
                    <option value="tramite" {{ old('status') == 'tramite' ? 'selected' : '' }}>En Trámite</option>
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--primary);">Vigencia Hasta</label>
                <input type="date" name="valid_until" value="{{ old('valid_until') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--primary);">Capacidad (Plazas/Hab)</label>
                <input type="number" name="capacity" value="{{ old('capacity', 0) }}" min="0" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem;">
            </div>
        </div>

        <button type="submit" class="btn" style="width: 100%; border: none; cursor: pointer;">Guardar Registro RTN</button>
    </form>
</div>

<script>
    const statesData = @json($states);
    const stateSelector = document.getElementById('state_selector');
    const munSelector = document.getElementById('municipality_selector');

    stateSelector.addEventListener('change', function() {
        const stateId = this.value;
        munSelector.innerHTML = '<option value="">Seleccione Municipio...</option>';
        
        if (stateId) {
            const state = statesData.find(s => s.id == stateId);
            state.municipalities.forEach(mun => {
                const opt = document.createElement('option');
                opt.value = mun.id;
                opt.textContent = mun.name;
                munSelector.appendChild(opt);
            });
        }
    });
</script>
@endsection
