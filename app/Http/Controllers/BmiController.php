<?php

namespace App\Http\Controllers;

use App\Models\BmiCalculation;
use App\Models\HistoryBmi;
use App\Http\Requests\BmiCalculationRequest;
use App\Services\BmiCalculatorService;
use App\Services\HealthSuggestionService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BmiController extends Controller
{
    protected BmiCalculatorService $bmiService;
    protected HealthSuggestionService $suggestionService;

    public function __construct(
        BmiCalculatorService $bmiService,
        HealthSuggestionService $suggestionService
    ) {
        $this->bmiService = $bmiService;
        $this->suggestionService = $suggestionService;
    }

    public function index(): View
    {
        $gender = auth()->user()->gender;
        return view('bmi.calculator', compact('gender'));
    }

    public function calculate(BmiCalculationRequest $request): RedirectResponse
    {       
        $height = $request->validated('height');
        $weight = $request->validated('weight');
        $gender = auth()->user()->gender;

        $calculations = $this->bmiService->calculateAll($height, $weight, $gender);
        // dd($calculations);

        $data = [
            'user_id' => auth()->id(),
            'tinggi_badan' => $height,
            'berat_badan' => $weight,
            'gender' => $gender,
            'nilai_bmi' => $calculations['nilai_bmi'],
            'kategori' => $calculations['kategori'],
            'ideal_berat_badan' => $calculations['ideal_berat_badan'],
            'minimum_berat_badan' => $calculations['minimum_berat_badan'],
            'maximum_berat_badan' => $calculations['maximum_berat_badan'],
            'tanggal' => now(),
        ];


        // Insert ke bmi_calculations
        $bmiRecord = BmiCalculation::create($data);

        // Insert ke history_bmi (1:1)
        HistoryBmi::create($data);

        return redirect()->route('bmi.result', ['id' => $bmiRecord->id_bmi]);
    }

    public function result(Request $request): View
    {
        $calculation = BmiCalculation::findOrFail($request->id);
        

        if ($calculation->user_id !== auth()->id()) {
            abort(403);
        }

        $suggestions = $this->suggestionService->getAllSuggestions($calculation->kategori);

        return view('bmi.result', compact('calculation', 'suggestions'));
    }
}