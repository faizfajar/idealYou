<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\BmiCalculation;
use Illuminate\Http\RedirectResponse;

/**
 * History Controller
 *
 * Handles BMI calculation history display.
 * Single Responsibility: Only manages history viewing
 */
class HistoryController extends Controller
{

    /**
     * Display BMI calculation history
     *
     * @return View
     */
    public function index(): View
    {
        // Get user's BMI calculations with pagination
        $calculations = auth()->user()
            ->bmiCalculations()
            ->latest()
            ->paginate(10);

        // Get statistics
        $totalCalculations = auth()->user()->bmiCalculations()->count();
        $latestCalculation = auth()->user()->bmiCalculations()->latest()->first();

        return view('bmi.history', compact(
            'calculations',
            'totalCalculations',
            'latestCalculation'
        ));
    }

    public function destroy($id): RedirectResponse
    {
        $calculation = BmiCalculation::findOrFail($id);
        
        if ($calculation->user_id !== auth()->id()) {
            abort(403);
        }
        
        $calculation->delete();
        
        return redirect()->route('bmi.history')->with('success', 'Data berhasil dihapus');
    }
}
