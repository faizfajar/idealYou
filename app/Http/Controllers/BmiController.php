<?php

namespace App\Http\Controllers;

use App\Models\BmiCalculation;
use App\Http\Requests\BmiCalculationRequest;
use App\Services\BmiCalculatorService;
use App\Services\HealthSuggestionService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * BMI Controller
 *
 * Handles all BMI calculation related operations.
 * Demonstrates OOP principles:
 * - Dependency Injection
 * - Single Responsibility
 * - Separation of Concerns
 */
class BmiController extends Controller
{
    /**
     * BMI Calculator Service instance
     *
     * @var BmiCalculatorService
     */
    protected BmiCalculatorService $bmiService;

    /**
     * Health Suggestion Service instance
     *
     * @var HealthSuggestionService
     */
    protected HealthSuggestionService $suggestionService;

    /**
     * Constructor - Dependency Injection
     *
     * @param BmiCalculatorService $bmiService
     * @param HealthSuggestionService $suggestionService
     */
    public function __construct(
        BmiCalculatorService $bmiService,
        HealthSuggestionService $suggestionService
    ) {
        $this->bmiService = $bmiService;
        $this->suggestionService = $suggestionService;
    }

    /**
     * Display BMI calculator form
     *
     * @return View
     */
    public function index(): View
    {
        $gender = auth()->user()->gender;

        return view('bmi.calculator', compact('gender'));
    }

    /**
     * Calculate BMI and store to database
     *
     * @param BmiCalculationRequest $request Validated request
     * @return RedirectResponse
     */
    public function calculate(BmiCalculationRequest $request): RedirectResponse
    {
        // Get validated data
        $height = $request->validated('height');
        $weight = $request->validated('weight');
        $gender = auth()->user()->gender;

        // Calculate all BMI values using service
        $calculations = $this->bmiService->calculateAll($height, $weight, $gender);

        // Store to database
        $bmiRecord = BmiCalculation::create([
            'user_id' => auth()->id(),
            'height' => $height,
            'weight' => $weight,
            'gender' => $gender,
            'bmi' => $calculations['bmi'],
            'category' => $calculations['category'],
            'ideal_weight' => $calculations['ideal_weight'],
            'min_weight' => $calculations['min_weight'],
            'max_weight' => $calculations['max_weight'],
        ]);

        // Redirect to result page with calculated data
        return redirect()->route('bmi.result', [
            'id' => $bmiRecord->id,
        ]);
    }

    /**
     * Display BMI calculation result
     *
     * @param Request $request
     * @return View
     */
    public function result(Request $request): View
    {
        // Get BMI calculation record
        $calculation = BmiCalculation::findOrFail($request->id);

        // Check authorization - only owner can view
        if ($calculation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Get health suggestions based on category
        $suggestions = $this->suggestionService->getAllSuggestions($calculation->category);

        return view('bmi.result', compact('calculation', 'suggestions'));
    }
}
