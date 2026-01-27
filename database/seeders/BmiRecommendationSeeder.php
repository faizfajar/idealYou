<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class BmiRecommendationSeeder extends Seeder
{
    public function run()
    {
        $foods = [
            // Underweight
            ['nama_makanan' => 'Nasi + Ayam Panggang', 'kategori_bmi' => 'Underweight', 'jenis_makanan' => 'Karbohidrat & Protein', 'kalori' => 550, 'deskripsi' => 'Membantu menambah massa otot dan energi harian'],
            ['nama_makanan' => 'Kentang Rebus', 'kategori_bmi' => 'Underweight', 'jenis_makanan' => 'Karbohidrat Kompleks', 'kalori' => 130, 'deskripsi' => 'Sumber energi sehat dan mudah dicerna'],
            ['nama_makanan' => 'Alpukat', 'kategori_bmi' => 'Underweight', 'jenis_makanan' => 'Lemak Sehat', 'kalori' => 160, 'deskripsi' => 'Tinggi kalori dan lemak baik untuk penambahan berat'],
            ['nama_makanan' => 'Susu Full Cream', 'kategori_bmi' => 'Underweight', 'jenis_makanan' => 'Protein & Lemak', 'kalori' => 150, 'deskripsi' => 'Membantu meningkatkan berat badan dan nutrisi'],
            ['nama_makanan' => 'Kacang Almond', 'kategori_bmi' => 'Underweight', 'jenis_makanan' => 'Lemak & Protein', 'kalori' => 170, 'deskripsi' => 'Camilan padat energi dan bergizi'],
            // Ideal
            ['nama_makanan' => 'Nasi Merah + Ikan Panggang', 'kategori_bmi' => 'Ideal', 'jenis_makanan' => 'Karbohidrat & Protein', 'kalori' => 450, 'deskripsi' => 'Menjaga energi dan kesehatan jantung'],
            ['nama_makanan' => 'Sayur Tumis', 'kategori_bmi' => 'Ideal', 'jenis_makanan' => 'Serat', 'kalori' => 100, 'deskripsi' => 'Membantu pencernaan dan menjaga berat badan'],
            ['nama_makanan' => 'Telur Rebus', 'kategori_bmi' => 'Ideal', 'jenis_makanan' => 'Protein', 'kalori' => 75, 'deskripsi' => 'Sumber protein sederhana dan seimbang'],
            ['nama_makanan' => 'Buah Apel', 'kategori_bmi' => 'Ideal', 'jenis_makanan' => 'Vitamin & Serat', 'kalori' => 95, 'deskripsi' => 'Menjaga metabolisme dan daya tahan tubuh'],
            ['nama_makanan' => 'Yogurt Plain', 'kategori_bmi' => 'Ideal', 'jenis_makanan' => 'Probiotik', 'kalori' => 120, 'deskripsi' => 'Menjaga kesehatan pencernaan'],
            // Overweight
            ['nama_makanan' => 'Nasi Merah (porsi kecil)', 'kategori_bmi' => 'Overweight', 'jenis_makanan' => 'Karbohidrat Kompleks', 'kalori' => 150, 'deskripsi' => 'Memberi energi tanpa lonjakan gula darah'],
            ['nama_makanan' => 'Dada Ayam Rebus', 'kategori_bmi' => 'Overweight', 'jenis_makanan' => 'Protein Rendah Lemak', 'kalori' => 165, 'deskripsi' => 'Membantu kenyang lebih lama'],
            ['nama_makanan' => 'Tumis Brokoli & Wortel', 'kategori_bmi' => 'Overweight', 'jenis_makanan' => 'Serat', 'kalori' => 90, 'deskripsi' => 'Rendah kalori dan kaya nutrisi'],
            ['nama_makanan' => 'Pepaya', 'kategori_bmi' => 'Overweight', 'jenis_makanan' => 'Buah', 'kalori' => 60, 'deskripsi' => 'Membantu pencernaan'],
            ['nama_makanan' => 'Teh Hijau', 'kategori_bmi' => 'Overweight', 'jenis_makanan' => 'Minuman', 'kalori' => 0, 'deskripsi' => 'Membantu metabolisme tubuh'],
            // Obesitas
            ['nama_makanan' => 'Sup Sayur', 'kategori_bmi' => 'Obesitas', 'jenis_makanan' => 'Serat', 'kalori' => 120, 'deskripsi' => 'Mengenyangkan dengan kalori rendah'],
            ['nama_makanan' => 'Ikan Kukus', 'kategori_bmi' => 'Obesitas', 'jenis_makanan' => 'Protein', 'kalori' => 180, 'deskripsi' => 'Protein sehat rendah lemak'],
            ['nama_makanan' => 'Tahu & Tempe Rebus', 'kategori_bmi' => 'Obesitas', 'jenis_makanan' => 'Protein Nabati', 'kalori' => 140, 'deskripsi' => 'Alternatif protein rendah kalori'],
            ['nama_makanan' => 'Buah Pir', 'kategori_bmi' => 'Obesitas', 'jenis_makanan' => 'Serat', 'kalori' => 85, 'deskripsi' => 'Membantu mengontrol nafsu makan'],
            ['nama_makanan' => 'Air Putih', 'kategori_bmi' => 'Obesitas', 'jenis_makanan' => 'Minuman', 'kalori' => 0, 'deskripsi' => 'Mendukung metabolisme dan detoks alami'],
        ];

        $exercises = [
            // Underweight
            ['nama_olahraga' => 'Latihan Beban Ringan', 'kategori_bmi' => 'Underweight', 'jenis' => 'Strength Training', 'durasi' => '30 menit', 'deskripsi' => 'Membantu pembentukan massa otot'],
            ['nama_olahraga' => 'Yoga', 'kategori_bmi' => 'Underweight', 'jenis' => 'Fleksibilitas', 'durasi' => '30-45 menit', 'deskripsi' => 'Meningkatkan keseimbangan dan postur'],
            ['nama_olahraga' => 'Pilates', 'kategori_bmi' => 'Underweight', 'jenis' => 'Core Training', 'durasi' => '30 menit', 'deskripsi' => 'Menguatkan otot inti tubuh'],
            ['nama_olahraga' => 'Jalan Santai', 'kategori_bmi' => 'Underweight', 'jenis' => 'Kardio Ringan', 'durasi' => '20-30 menit', 'deskripsi' => 'Menjaga kebugaran tanpa membakar banyak kalori'],
            ['nama_olahraga' => 'Stretching', 'kategori_bmi' => 'Underweight', 'jenis' => 'Fleksibilitas', 'durasi' => '15 menit', 'deskripsi' => 'Mencegah cedera dan meningkatkan kelenturan'],
            // Ideal
            ['nama_olahraga' => 'Jogging', 'kategori_bmi' => 'Ideal', 'jenis' => 'Kardio', 'durasi' => '30 menit', 'deskripsi' => 'Menjaga kesehatan jantung'],
            ['nama_olahraga' => 'Bersepeda', 'kategori_bmi' => 'Ideal', 'jenis' => 'Kardio', 'durasi' => '30-45 menit', 'deskripsi' => 'Meningkatkan stamina dan kekuatan kaki'],
            ['nama_olahraga' => 'Senam Aerobik', 'kategori_bmi' => 'Ideal', 'jenis' => 'Kardio', 'durasi' => '30 menit', 'deskripsi' => 'Membakar kalori secara seimbang'],
            ['nama_olahraga' => 'Bodyweight Training', 'kategori_bmi' => 'Ideal', 'jenis' => 'Strength', 'durasi' => '30 menit', 'deskripsi' => 'Menjaga kekuatan otot'],
            ['nama_olahraga' => 'Renang', 'kategori_bmi' => 'Ideal', 'jenis' => 'Full Body', 'durasi' => '30 menit', 'deskripsi' => 'Melatih seluruh otot tubuh'],
            // Overweight
            ['nama_olahraga' => 'Jalan Cepat', 'kategori_bmi' => 'Overweight', 'jenis' => 'Kardio', 'durasi' => '30-45 menit', 'deskripsi' => 'Efektif membakar lemak dengan risiko cedera rendah'],
            ['nama_olahraga' => 'Bersepeda Statis', 'kategori_bmi' => 'Overweight', 'jenis' => 'Kardio', 'durasi' => '30 menit', 'deskripsi' => 'Aman untuk lutut'],
            ['nama_olahraga' => 'Renang', 'kategori_bmi' => 'Overweight', 'jenis' => 'Kardio', 'durasi' => '30 menit', 'deskripsi' => 'Mengurangi tekanan pada sendi'],
            ['nama_olahraga' => 'Senam Low Impact', 'kategori_bmi' => 'Overweight', 'jenis' => 'Kardio', 'durasi' => '30 menit', 'deskripsi' => 'Cocok untuk pemula'],
            ['nama_olahraga' => 'Yoga', 'kategori_bmi' => 'Overweight', 'jenis' => 'Fleksibilitas', 'durasi' => '30 menit', 'deskripsi' => 'Membantu kontrol berat badan dan stres'],
            // Obesitas
            ['nama_olahraga' => 'Jalan Santai', 'kategori_bmi' => 'Obesitas', 'jenis' => 'Kardio Ringan', 'durasi' => '20-30 menit', 'deskripsi' => 'Langkah awal meningkatkan aktivitas fisik'],
            ['nama_olahraga' => 'Senam Duduk', 'kategori_bmi' => 'Obesitas', 'jenis' => 'Low Impact', 'durasi' => '15-20 menit', 'deskripsi' => 'Aman bagi penderita obesitas'],
            ['nama_olahraga' => 'Peregangan', 'kategori_bmi' => 'Obesitas', 'jenis' => 'Fleksibilitas', 'durasi' => '15 menit', 'deskripsi' => 'Mengurangi kekakuan otot'],
            ['nama_olahraga' => 'Renang', 'kategori_bmi' => 'Obesitas', 'jenis' => 'Kardio', 'durasi' => '20-30 menit', 'deskripsi' => 'Minim tekanan pada sendi'],
            ['nama_olahraga' => 'Tai Chi', 'kategori_bmi' => 'Obesitas', 'jenis' => 'Keseimbangan', 'durasi' => '20 menit', 'deskripsi' => 'Meningkatkan kontrol gerak dan relaksasi'],
        ];

        // Proses data makanan
        foreach ($foods as &$food) {
            $food['gambar'] = $this->getImagePath('rekomendasi_makanan', $food['jenis_makanan']);
        }

        // Proses data olahraga
        foreach ($exercises as &$exercise) {
            $exercise['gambar'] = $this->getImagePath('rekomendasi_olahraga', $exercise['jenis']);
        }

        DB::table('rekomendasi_makanan')->insert($foods);   
        DB::table('rekomendasi_olahraga')->insert($exercises);
    }

    /**
     * Fungsi untuk mencari file gambar dengan berbagai ekstensi
     */
    private function getImagePath($folder, $jenis, $itemName = null)
    {
        $mapping = [
            'karbohidrat & protein' => 'karbohidrat',
            'vitamin & serat'       => 'vitamin',
            'protein & lemak'       => 'protein',
            'lemak & protein'       => 'protein',
            'strength training'     => 'strength_training',
            'core training'         => 'core_training',
            'kardio ringan'         => 'kardio_ringan',
            'low impact'            => 'low_impact',
            'protein rendah lemak'  => 'protein_rendah_lemak',
            'protein nabati'        => 'protein_nabati',
            'karbohidrat kompleks'  => 'karbohidrat_kompleks',
        ];

        $baseName = str_replace(' ', '_', strtolower($jenis));

        // Jika ada di mapping, gunakan nama pendeknya
        if (array_key_exists(strtolower($jenis), $mapping)) {
            $baseName = $mapping[strtolower($jenis)];
        }

        // Khusus untuk Minuman (karena ada air_putih dan minuman_teh)
        if (strtolower($jenis) == 'minuman') {
            $baseName = (strtolower($itemName) == 'air putih') ? 'air_putih' : 'minuman_teh';
        }

        $extensions = ['jpg', 'jpeg', 'png', 'webp'];
        $subFolder = "img/{$folder}/";

        // Cek apakah file fisik ada
        foreach ($extensions as $ext) {
            $fullPath = public_path($subFolder . $baseName . '.' . $ext);
            if (File::exists($fullPath)) {
                return $subFolder . $baseName . '.' . $ext;
            }
        }

        return null;
    }
}