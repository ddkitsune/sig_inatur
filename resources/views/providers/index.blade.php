@extends('layouts.app')

@section('content')
<div class="header">
    <h1><i class="fas fa-users-gear" style="color: var(--primary);"></i> Gestión de Prestadores (RTN)</h1>
    <div class="actions">
        <a href="{{ route('providers.create') }}" class="btn">
            <i class="fas fa-plus"></i> Nuevo Registro
        </a>
    </div>
</div>

<div class="card" style="margin-bottom: 2rem;">
    <form action="{{ route('providers.index') }}" method="GET" style="display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 200px;">
            <label style="display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem; color: #666;">Búsqueda por nombre, RTN o RIF</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ej: Hotel, J-123..." 
                style="width: 100%; padding: 0.6rem 1rem; border: 1px solid #ddd; border-radius: 8px;">
        </div>
        <div style="width: 200px;">
            <label style="display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem; color: #666;">Filtrar por Categoría</label>
            <select name="category_id" style="width: 100%; padding: 0.6rem 1rem; border: 1px solid #ddd; border-radius: 8px;">
                <option value="">Todas las categorías</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-outline" style="padding: 0.6rem 1.5rem; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-filter"></i> Filtrar
        </button>
        @if(request()->anyFilled(['search', 'category_id']))
            <a href="{{ route('providers.index') }}" class="btn btn-outline" style="border-color: #999; color: #666; padding: 0.6rem 1.5rem;">
                Limpiar
            </a>
        @endif
    </form>
</div>

@if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-title" style="margin-bottom: 1.5rem;">Listado General de Prestadores</div>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 1rem;">RTN</th>
                    <th style="padding: 1rem;">Razón Social</th>
                    <th style="padding: 1rem;">Categoría</th>
                    <th style="padding: 1rem;">Ubicación</th>
                    <th style="padding: 1rem;">Estatus</th>
                    <th style="padding: 1rem;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($providers as $provider)
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 1rem; font-weight: 600;">{{ $provider->num_rtn }}</td>
                        <td style="padding: 1rem;">
                            <div style="font-weight: 600;">{{ $provider->razon_social }}</div>
                            <div style="font-size: 0.75rem; color: #666;">RIF: {{ $provider->rif }}</div>
                        </td>
                        <td style="padding: 1rem;">
                            <span style="background: #e0e7ff; color: #4338ca; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem;">
                                {{ $provider->category->name }}
                            </span>
                        </td>
                        <td style="padding: 1rem;">
                            <div>{{ $provider->municipality->state->name }}</div>
                            <div style="font-size: 0.75rem; color: #666;">{{ $provider->municipality->name }}</div>
                        </td>
                        <td style="padding: 1rem;">
                            @if($provider->status == 'activo')
                                <span style="color: #166534; background: #dcfce7; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 700;">ACTIVO</span>
                            @elseif($provider->status == 'vencido')
                                <span style="color: #991b1b; background: #fee2e2; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 700;">VENCIDO</span>
                            @else
                                <span style="color: #854d0e; background: #fef9c3; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 700;">TRÁMITE</span>
                            @endif
                        </td>
                        <td style="padding: 1rem; display: flex; gap: 0.5rem;">
                            <a href="{{ route('providers.show', $provider) }}" class="btn btn-outline" style="padding: 0.5rem 0.75rem; font-size: 0.8rem; display: flex; align-items: center; gap: 5px;" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('providers.edit', $provider) }}" class="btn btn-outline" style="padding: 0.5rem 0.75rem; font-size: 0.8rem; border-color: #4b5563; color: #4b5563; display: flex; align-items: center; gap: 5px;" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('providers.destroy', $provider) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este registro?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="padding: 0.5rem 0.75rem; font-size: 0.8rem; border-color: #ef4444; color: #ef4444; cursor: pointer; display: flex; align-items: center; gap: 5px;" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if($providers->isEmpty())
                    <tr>
                        <td colspan="5" style="padding: 2rem; text-align: center; color: #666;">
                            No hay prestadores registrados todavía.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
