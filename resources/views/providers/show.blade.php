@extends('layouts.app')

@section('content')
<div class="header">
    <h1>Expediente del Prestador</h1>
    <div class="actions" style="display: flex; gap: 0.5rem;">
        <a href="{{ route('providers.index') }}" class="btn btn-outline">Volver al Listado</a>
        <a href="{{ route('providers.edit', $provider) }}" class="btn btn-outline" style="border-color: #4b5563; color: #4b5563;">Editar</a>
        <form action="{{ route('providers.destroy', $provider) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este registro?');" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline" style="border-color: #ef4444; color: #ef4444; cursor: pointer;">Eliminar</button>
        </form>
    </div>
</div>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem; border-bottom: 1px solid #eee; padding-bottom: 1rem;">
        <div>
            <h2 style="color: var(--primary); margin-bottom: 0.5rem;">{{ $provider->razon_social }}</h2>
            <span style="background: #e0e7ff; color: #4338ca; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600;">
                {{ $provider->category->name }}
            </span>
        </div>
        <div style="text-align: right;">
            <div style="font-weight: 700; font-size: 1.25rem;">RTN: {{ $provider->num_rtn }}</div>
            <div style="color: #666;">RIF: {{ $provider->rif }}</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        <div>
            <h3 style="font-size: 1rem; margin-bottom: 1rem; color: #555; border-left: 4px solid var(--accent); padding-left: 0.5rem;">Información de Contacto</h3>
            <p style="margin-bottom: 0.75rem;"><strong>Teléfono:</strong> {{ $provider->telefono }}</p>
            <p style="margin-bottom: 0.75rem;"><strong>Email:</strong> {{ $provider->email }}</p>
            <p style="margin-bottom: 0.75rem;"><strong>Dirección:</strong> {{ $provider->direccion }}</p>
        </div>
        <div>
            <h3 style="font-size: 1rem; margin-bottom: 1rem; color: #555; border-left: 4px solid var(--accent); padding-left: 0.5rem;">Ubicación Geográfica</h3>
            <p style="margin-bottom: 0.75rem;"><strong>Estado:</strong> {{ $provider->municipality->state->name }}</p>
            <p style="margin-bottom: 0.75rem;"><strong>Municipio:</strong> {{ $provider->municipality->name }}</p>
        </div>
    </div>

    <div style="margin-top: 2rem; padding: 1.5rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; display: grid; grid-template-columns: 1fr 1fr 1fr; text-align: center;">
        <div>
            <div style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 0.5rem;">Estatus Legal</div>
            @if($provider->status == 'activo')
                <span style="background: #dcfce7; color: #166534; padding: 0.4rem 1rem; border-radius: 9999px; font-weight: 700; font-size: 0.8rem;">ACTIVO</span>
            @elseif($provider->status == 'vencido')
                <span style="background: #fee2e2; color: #991b1b; padding: 0.4rem 1rem; border-radius: 9999px; font-weight: 700; font-size: 0.8rem;">VENCIDO</span>
            @else
                <span style="background: #fef9c3; color: #854d0e; padding: 0.4rem 1rem; border-radius: 9999px; font-weight: 700; font-size: 0.8rem;">EN TRÁMITE</span>
            @endif
        </div>
        <div>
            <div style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 0.5rem;">Vigencia RTN</div>
            <div style="font-weight: 700; color: var(--primary);">{{ $provider->valid_until ? \Carbon\Carbon::parse($provider->valid_until)->format('d/m/Y') : 'N/A' }}</div>
        </div>
        <div>
            <div style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 0.5rem;">Capacidad Oferta</div>
            <div style="font-weight: 700; color: var(--primary);">{{ $provider->capacity }} Plazas/Hab</div>
        </div>
    </div>

    <div style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid #eee; text-align: center;">
        <p style="font-size: 0.8rem; color: #999;">Registrado el: {{ $provider->created_at->format('d/m/Y H:i') }}</p>
    </div>
</div>
@endsection
