<?php

namespace App\Services;

use App\Models\RekomendasiMakanan;
use App\Models\RekomendasiOlahraga;
use App\Models\TipsSehat;

/**
 * Health Suggestion Service
 * 
 * This service provides health suggestions from database or fallback to default.
 * Single Responsibility: Only handles health recommendations
 */
class HealthSuggestionService
{
    /**
     * Get diet suggestions from database based on BMI category
     * Falls back to default suggestions if database is empty
     * 
     * @param string $category BMI category
     * @return array Diet suggestions
     */
   public function getDietSuggestions(string $category): array
    {
        $makanan = RekomendasiMakanan::where('kategori_bmi', $category)->get();

        if ($makanan->isNotEmpty()) {
            return $makanan->groupBy('jenis_makanan')
                ->map(function ($items) {
                    return $items->map(function ($item) {
                        // Buat format teks seperti sebelumnya
                        $text = $item->nama_makanan;
                        if ($item->deskripsi) $text .= ' - ' . $item->deskripsi;
                        if ($item->kalori) $text .= ' (' . $item->kalori . ' kalori)';

                        return $text;
                    })->toArray();
                })->toArray();
        }

        return $this->getDefaultDietSuggestions($category);
    }

    /**
     * Get exercise suggestions from database based on BMI category
     * Falls back to default suggestions if database is empty
     * 
     * @param string $category BMI category
     * @return array Exercise suggestions
     */
    public function getExerciseSuggestions(string $category): array
    {
        // Ambil data dari database
        $olahraga = RekomendasiOlahraga::where('kategori_bmi', $category)->get();
        
        // Jika ada data, kelompokkan berdasarkan 'jenis_olahraga'
        if ($olahraga->isNotEmpty()) {
            return $olahraga->groupBy('jenis')
                ->map(function ($items) {
                    return $items->map(function ($item) {
                        $text = $item->nama_olahraga;
                        
                        if ($item->deskripsi) {
                            $text .= ' - ' . $item->deskripsi;
                        }
                        
                        // Menambahkan durasi (misal: "30 menit") ke dalam teks
                        if ($item->durasi) {
                            $text .= ' (' . $item->durasi . ')';
                        }
                        
                        return $text;
                    })->toArray();
                })->toArray();
        }

        // Pastikan fungsi fallback ini juga return format array yang sudah dikelompokkan
        return $this->getDefaultExerciseSuggestions($category);
    }

    /**
     * Get health tips from database
     * Falls back to default tips if database is empty
     * 
     * @param string|null $category BMI category (optional)
     * @return array Health tips
     */
    public function getTipsSehat(?string $category = null): array
    {
        $query = TipsSehat::query();
        
        // Filter by category if provided
        if ($category) {
            $query->where('kategori', $category);
        }
        
        $tips = $query->get();
        
        // If database has data, return formatted data
        if ($tips->isNotEmpty()) {
            return $tips->map(function($item) {
                return [
                    'judul' => $item->judul,
                    'deskripsi' => $item->deskripsi,
                ];
            })->toArray();
        }

        // Fallback to default tips
        return $this->getDefaultTips();
    }

    /**
     * Get all suggestions at once
     * 
     * @param string $category BMI category
     * @return array All suggestions (diet, exercise, tips)
     */
    public function getAllSuggestions(string $category): array
    {

        $makanan = RekomendasiMakanan::where('kategori_bmi', $category)->get();
        $olahraga = RekomendasiOlahraga::where('kategori_bmi', $category)->get();

        return [
            'diet' => $this->getDietSuggestions($category),
            'exercise' => $this->getExerciseSuggestions($category),
            'tips' => $this->getTipsSehat($category),

            'diet_images' => $makanan->pluck('gambar')->toArray(),
            'exercise_images' => $olahraga->pluck('gambar')->toArray(),
        ];
    }

    /**
     * Default diet suggestions when database is empty
     * 
     * @param string $category BMI category
     * @return array Default diet suggestions
     */
    private function getDefaultDietSuggestions(string $category): array
    {
        return match($category) {
            'Underweight' => [
                'Tingkatkan asupan kalori dengan makanan bergizi tinggi',
                'Konsumsi protein tinggi seperti daging, ikan, telur, dan kacang-kacangan',
                'Makan 5-6 kali sehari dengan porsi sedang',
                'Tambahkan smoothie, shake, atau jus buah berkalori tinggi',
                'Konsumsi karbohidrat kompleks seperti nasi merah, oat, dan kentang',
                'Tambahkan lemak sehat dari alpukat, kacang-kacangan, dan minyak zaitun',
                'Hindari makan terlalu banyak serat sebelum makan utama',
            ],
            
            'Ideal' => [
                'Pertahankan pola makan seimbang dengan gizi seimbang',
                'Konsumsi sayur dan buah minimal 5 porsi per hari',
                'Pilih protein tanpa lemak seperti ayam, ikan, tahu, dan tempe',
                'Batasi konsumsi gula tambahan dan makanan olahan',
                'Minum air putih minimal 8 gelas per hari',
                'Konsumsi whole grains seperti beras merah, roti gandum',
                'Jaga porsi makan tetap teratur 3 kali sehari dengan 2 kali snack sehat',
            ],
            
            'Overweight' => [
                'Kurangi asupan kalori sekitar 500 kalori per hari',
                'Perbanyak sayuran hijau dan protein tanpa lemak',
                'Hindari makanan tinggi gula, lemak jenuh, dan makanan cepat saji',
                'Konsumsi whole grains dan perbanyak serat',
                'Ganti minuman manis dengan air putih atau teh tanpa gula',
                'Catat asupan makanan harian untuk monitoring',
                'Makan dengan porsi lebih kecil tapi lebih sering',
                'Hindari makan malam terlalu larut',
            ],
            
            'Obesitas' => [
                'Kurangi asupan kalori secara signifikan (konsultasi dengan ahli gizi)',
                'Fokus pada sayuran, buah-buahan, dan protein rendah lemak',
                'Hindari sepenuhnya makanan cepat saji, gorengan, dan makanan olahan',
                'Batasi karbohidrat sederhana dan ganti dengan karbohidrat kompleks',
                'Hindari minuman bersoda, jus kemasan, dan minuman tinggi gula',
                'Praktikkan mindful eating - makan perlahan dan nikmati makanan',
                'Gunakan piring lebih kecil untuk mengontrol porsi',
                'Meal prep untuk memastikan makanan sehat tersedia',
                'Konsultasikan dengan dokter atau ahli gizi untuk program diet khusus',
            ],
            
            default => [
                'Konsultasikan dengan ahli gizi untuk saran yang lebih spesifik',
                'Pertahankan pola makan seimbang',
                'Minum air putih yang cukup',
            ],
        };
    }

    /**
     * Default exercise suggestions when database is empty
     * 
     * @param string $category BMI category
     * @return array Default exercise suggestions
     */
    private function getDefaultExerciseSuggestions(string $category): array
    {
        return match($category) {
            'Underweight' => [
                'Fokus pada latihan beban untuk membangun massa otot',
                'Lakukan strength training seperti squat, deadlift, bench press 3-4x seminggu',
                'Hindari cardio intensitas tinggi yang berlebihan',
                'Latihan dengan repetisi rendah (6-12 reps) dan beban berat',
                'Istirahat cukup minimal 48 jam antara sesi latihan kelompok otot yang sama',
                'Konsumsi protein shake setelah latihan',
                'Durasi olahraga 45-60 menit per sesi',
            ],
            
            'Ideal' => [
                'Lakukan cardio moderat 150 menit per minggu (jalan cepat, jogging, bersepeda)',
                'Latihan kekuatan 2-3x seminggu untuk semua kelompok otot utama',
                'Tambahkan yoga atau stretching 2x seminggu untuk fleksibilitas',
                'Variasikan jenis olahraga agar tidak bosan',
                'Pilih olahraga yang Anda nikmati agar konsisten',
                'Gabungkan aktivitas fisik dalam rutinitas harian',
            ],
            
            'Overweight' => [
                'Lakukan cardio 200-250 menit per minggu dengan intensitas sedang',
                'Kombinasikan steady-state cardio (jogging, bersepeda) dengan interval training',
                'Latihan kekuatan 3x seminggu untuk meningkatkan metabolisme',
                'Tambahkan aktivitas harian seperti naik tangga, jalan kaki saat istirahat',
                'Mulai dengan intensitas rendah dan tingkatkan secara bertahap',
                'Monitor detak jantung untuk memastikan berada di zona fat burning',
                'Konsistensi lebih penting daripada intensitas tinggi',
            ],
            
            'Obesitas' => [
                'Mulai dengan aktivitas ringan seperti jalan kaki 30 menit setiap hari',
                'Lakukan cardio intensitas rendah hingga sedang minimal 250-300 menit per minggu',
                'Kombinasi HIIT (High Intensity Interval Training) saat sudah lebih fit',
                'Latihan kekuatan 3-4x seminggu untuk membangun otot dan meningkatkan metabolisme',
                'Water aerobics atau berenang untuk mengurangi tekanan pada sendi',
                'Tambahkan aktivitas fisik dalam rutinitas harian sebanyak mungkin',
                'Gunakan pedometer atau fitness tracker untuk memotivasi mencapai 10,000 langkah/hari',
                'PENTING: Konsultasikan dengan dokter sebelum memulai program olahraga',
                'Mulai perlahan dan tingkatkan intensitas secara bertahap untuk menghindari cedera',
            ],
            
            default => [
                'Konsultasikan dengan pelatih atau dokter untuk program yang tepat',
                'Lakukan aktivitas fisik secara teratur',
                'Dengarkan tubuh Anda dan istirahat saat diperlukan',
            ],
        };
    }

    /**
     * Default health tips when database is empty
     * 
     * @return array Default tips
     */
    private function getDefaultTips(): array
    {
        return [
            [
                'judul' => 'Cukupi Kebutuhan Air',
                'deskripsi' => 'Minum air putih minimal 8 gelas per hari. Sekitar 60% dari komposisi tubuh Anda adalah air.',
            ],
            [
                'judul' => 'Manajemen Stres',
                'deskripsi' => 'Hindari stres berlebihan. Cobalah teknik relaksasi seperti meditasi atau yoga untuk menenangkan pikiran.',
            ],
            [
                'judul' => 'Kualitas Istirahat',
                'deskripsi' => 'Tidur cukup 7-8 jam setiap malam. Istirahat yang baik penting untuk pemulihan tubuh dan metabolisme.',
            ],
            [
                'judul' => 'Aktivitas Fisik Rutin',
                'deskripsi' => 'Lakukan olahraga secara teratur minimal 150 menit per minggu untuk menjaga kesehatan jantung.',
            ],
            [
                'judul' => 'Konsistensi adalah Kunci',
                'deskripsi' => 'Perubahan kecil yang konsisten lebih baik daripada perubahan besar yang tidak berkelanjutan.',
            ],
        ];
    }
}