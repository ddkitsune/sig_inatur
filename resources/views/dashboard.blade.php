@extends('layouts.app')

@section('content')
<div class="header">
    <h1>Panel de Control Gerencial</h1>
    <div class="actions">
        <a href="{{ route('reports.rtn') }}" class="btn">Generar Reporte RTN</a>
    </div>
</div>

<div class="stats-grid">
    <div class="card" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
        <div style="background: #e0f2fe; color: #0369a1; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1rem;">
            <i class="fas fa-id-card-clip"></i>
        </div>
        <div class="card-title">Total RTN Registrados</div>
        <div class="card-value" style="font-size: 3rem;">{{ $totalProviders }}</div>
        <p style="color: #666; font-size: 0.8rem; font-weight: 500;">Prestadores Activos</p>
    </div>

    <div class="card" style="grid-column: span 1;">
        <div class="card-title"><i class="fas fa-chart-pie" style="margin-right: 8px;"></i> Categoría</div>
        <div style="height: 200px; position: relative; margin-top: 1rem;">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>

    <div class="card" style="grid-column: span 1;">
        <div class="card-title"><i class="fas fa-scale-balanced" style="margin-right: 8px;"></i> Estatus Legal (RTN)</div>
        <div style="height: 200px; position: relative; margin-top: 1rem;">
            <canvas id="statusChart"></canvas>
        </div>
    </div>
</div>

<div class="stats-grid" style="margin-top: 2rem;">
    <div class="card" style="grid-column: span 3;">
        <div class="card-title"><i class="fas fa-map-location-dot" style="margin-right: 8px;"></i> Presencia RTN por Estado</div>
        <div style="height: 300px; margin-top: 1rem;">
            <canvas id="stateChart"></canvas>
        </div>
    </div>
</div>

<script>
    // Gráfico de Categorías
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: @json($statsByCategory->pluck('name')),
            datasets: [{
                data: @json($statsByCategory->pluck('tourist_providers_count')),
                backgroundColor: ['#003366', '#ff9900', '#0ea5e9', '#10b981', '#f43f5e', '#8b5cf6'],
                borderWidth: 2,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' }
            }
        }
    });

    // Gráfico de Estatus
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: ['Activo', 'Vencido', 'En Trámite'],
            datasets: [{
                data: [
                    {{ $statsByStatus['activo'] }},
                    {{ $statsByStatus['vencido'] }},
                    {{ $statsByStatus['tramite'] }}
                ],
                backgroundColor: ['#10b981', '#f43f5e', '#fbbf24'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Gráfico de Estados
    const stateCtx = document.getElementById('stateChart').getContext('2d');
    new Chart(stateCtx, {
        type: 'bar',
        data: {
            labels: @json($statsByState->pluck('name')),
            datasets: [{
                label: 'Número de Prestadores',
                data: @json($statsByState->pluck('tourist_providers_count')),
                backgroundColor: 'rgba(0, 51, 102, 0.8)',
                borderColor: '#003366',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

<div class="card" style="margin-top: 2rem;">
    <div class="card-title" style="margin-bottom: 1rem;">Misión del SIG-INATUR</div>
    <p style="line-height: 1.6; color: #444;">
        Este sistema ha sido desarrollado para centralizar y automatizar la gestión de datos del Registro Turístico Nacional (RTN). 
        Permite a la gerencia de INATUR obtener información precisa y en tiempo real para la planificación estratégica del sector turismo en Venezuela.
    </p>
</div>
@endsection
