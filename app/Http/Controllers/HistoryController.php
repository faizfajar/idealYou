<?php

namespace App\Http\Controllers;

use App\Models\HistoryBmi;
use App\Services\HealthSuggestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;


class HistoryController extends Controller
{

    protected HealthSuggestionService $suggestionService;

    public function __construct(
        HealthSuggestionService $suggestionService
    ) {
        $this->suggestionService = $suggestionService;
    }

    public function index(): View
    {
        $calculations = HistoryBmi::where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        $totalCalculations = HistoryBmi::where('user_id', auth()->id())->count();
        $latestCalculation = HistoryBmi::where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->first();

        // dd($calculations);
        return view('bmi.history', compact(
            'calculations',
            'totalCalculations',
            'latestCalculation'
        ));
    }

    public function detail($id): View
{
    $calculation = HistoryBmi::findOrFail($id);
    

    if ($calculation->user_id !== auth()->id()) {
        abort(403, 'Aksi tidak diizinkan.');
    }

    $suggestions = $this->suggestionService->getAllSuggestions($calculation->kategori);

    return view('bmi.result', compact('calculation', 'suggestions'));
}

    public function destroy($id): RedirectResponse
    {
        $calculation = HistoryBmi::findOrFail($id);
        
        if ($calculation->user_id !== auth()->id()) {
            abort(403);
        }
        
        $calculation->delete();
        
        return redirect()->route('bmi.history')->with('success', 'Data berhasil dihapus');
    }
}