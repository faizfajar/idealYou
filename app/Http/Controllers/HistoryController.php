<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

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
}
