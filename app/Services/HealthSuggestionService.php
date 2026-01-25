<?php

namespace App\Services;

/**
 * Health Suggestion Service
 *
 * This service provides health suggestions based on BMI category.
 * Single Responsibility: Only handles health recommendations
 */
class HealthSuggestionService
{
    /**
     * Get diet suggestions based on BMI category
     *
     * @param string $category BMI category
     * @return array Diet suggestions
     */
    public function getDietSuggestions(string $category): array
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
     * Get exercise suggestions based on BMI category
     *
     * @param string $category BMI category
     * @return array Exercise suggestions
     */
    public function getExerciseSuggestions(string $category): array
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
     * Get weekly schedule suggestions based on BMI category
     *
     * @param string $category BMI category
     * @return array Weekly schedule
     */
    public function getWeeklySchedule(string $category): array
    {
        return match($category) {
            'Underweight' => [
                'Senin: Latihan kekuatan upper body (dada, bahu, trisep) - 45 menit',
                'Selasa: Istirahat aktif - stretching atau yoga ringan 20 menit',
                'Rabu: Latihan kekuatan lower body (kaki, glutes) - 45 menit',
                'Kamis: Istirahat penuh - fokus pada pemulihan otot',
                'Jumat: Latihan kekuatan full body atau back & biceps - 45 menit',
                'Sabtu: Aktivitas ringan seperti jalan santai atau berenang 30 menit',
                'Minggu: Istirahat penuh - meal prep untuk minggu depan',
            ],

            'Ideal' => [
                'Senin: Latihan kardio 30-45 menit (jogging atau bersepeda)',
                'Selasa: Latihan kekuatan upper body - 40 menit',
                'Rabu: Yoga atau pilates - 45 menit',
                'Kamis: Latihan kardio 30-45 menit (berenang atau zumba)',
                'Jumat: Latihan kekuatan lower body - 40 menit',
                'Sabtu: Aktivitas outdoor atau olahraga favorit (hiking, basket) - 60 menit',
                'Minggu: Istirahat aktif - jalan santai atau stretching ringan 30 menit',
            ],

            'Overweight' => [
                'Senin: Kardio intensitas sedang 40-50 menit + stretching 10 menit',
                'Selasa: Latihan kekuatan full body - 30 menit + jalan kaki 20 menit',
                'Rabu: HIIT atau interval training 30 menit + core workout 15 menit',
                'Kamis: Kardio intensitas sedang 40-50 menit + stretching 10 menit',
                'Jumat: Latihan kekuatan full body - 30 menit + jalan kaki 20 menit',
                'Sabtu: Aktivitas outdoor aktif (hiking, bersepeda) - 60-90 menit',
                'Minggu: Yoga atau stretching - 30 menit, fokus pada recovery',
            ],

            'Obesitas' => [
                'Senin: Jalan cepat 30 menit pagi + latihan kekuatan ringan 20 menit sore',
                'Selasa: Berenang atau water aerobics 40 menit',
                'Rabu: Jalan cepat 30 menit + stretching 15 menit',
                'Kamis: Latihan kekuatan full body ringan-sedang 30 menit',
                'Jumat: Jalan cepat 40 menit + core workout 10 menit',
                'Sabtu: Aktivitas favorit intensitas rendah 45-60 menit (bersepeda santai, hiking ringan)',
                'Minggu: Jalan santai 30 menit + yoga atau stretching 20 menit',
                'CATATAN: Tambahkan jalan kaki 10-15 menit setelah setiap makan',
            ],

            default => [
                'Konsultasikan dengan pelatih untuk jadwal yang disesuaikan',
                'Lakukan aktivitas fisik minimal 150 menit per minggu',
                'Istirahat yang cukup sangat penting untuk pemulihan',
            ],
        };
    }

    /**
     * Get all suggestions at once
     *
     * @param string $category BMI category
     * @return array All suggestions
     */
    public function getAllSuggestions(string $category): array
    {
        return [
            'diet' => $this->getDietSuggestions($category),
            'exercise' => $this->getExerciseSuggestions($category),
            'schedule' => $this->getWeeklySchedule($category),
        ];
    }

    /**
     * Get motivational message based on category
     *
     * @param string $category BMI category
     * @return string Motivational message
     */
    public function getMotivationalMessage(string $category): string
    {
        return match($category) {
            'Underweight' =>
                'Fokus pada penambahan massa otot dan berat badan yang sehat. Konsistensi dalam makan dan latihan adalah kunci!',

            'Ideal' =>
                'Pertahankan gaya hidup sehat Anda! Konsistensi adalah kunci untuk tetap di zona sehat.',

            'Overweight' =>
                'Anda berada di jalur yang tepat! Dengan komitmen dan konsistensi, target berat ideal bisa tercapai.',

            'Obesitas' =>
                'Perjalanan menuju kesehatan dimulai dari satu langkah. Jangan menyerah, konsultasikan dengan profesional, dan rayakan setiap progress kecil!',

            default =>
                'Konsultasikan dengan ahli kesehatan untuk panduan yang tepat.',
        };
    }
}
