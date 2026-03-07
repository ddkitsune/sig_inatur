<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TouristProvider;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function downloadRTNReport(Request $request)
    {
        $query = TouristProvider::with(['category', 'municipality.state']);

        // Filtros opcionales
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('state_id')) {
            $query->whereHas('municipality', function($q) use ($request) {
                $q->where('state_id', $request->state_id);
            });
        }

        $providers = $query->get();

        $pdf = Pdf::loadView('reports.rtn', compact('providers'));
        
        return $pdf->download('reporte-rtn-'.now()->format('YmdHis').'.pdf');
    }
}
