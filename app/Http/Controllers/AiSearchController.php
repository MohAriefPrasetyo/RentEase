<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class AiSearchController extends Controller
{
    /**
     * Tampilkan halaman AI Search (state awal, tanpa hasil).
     */
    public function index()
    {
        return view('Ai search', [
            'results'   => null,
            'query'     => '',
            'aiMessage' => '',
        ]);
    }

    /**
     * Proses pencarian berdasarkan query natural language.
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = trim($request->input('query'));

        // Pecah query menjadi kata-kata kunci
        $keywords = array_filter(explode(' ', strtolower($query)));

        // Cari peralatan yang nama atau kategorinya cocok dengan salah satu kata kunci
        $equipmentQuery = Equipment::with('category');

        $equipmentQuery->where(function ($q) use ($keywords) {
            foreach ($keywords as $keyword) {
                $q->orWhere('equipment_name', 'LIKE', "%{$keyword}%")
                  ->orWhereHas('category', function ($q2) use ($keyword) {
                      $q2->where('category_name', 'LIKE', "%{$keyword}%");
                  });
            }
        });

        // Filter harga jika ada kata kunci harga (misal: "murah", "di bawah 50000")
        if ($this->containsPriceHint($query, 'murah', 'terjangkau', 'hemat', 'ekonomis')) {
            $equipmentQuery->orderBy('rental_price_per_day', 'asc');
        } elseif ($this->containsPriceHint($query, 'mahal', 'premium', 'bagus', 'terbaik', 'berkualitas')) {
            $equipmentQuery->orderBy('rental_price_per_day', 'desc');
        }

        // Ambil batas harga jika disebutkan (misal: "di bawah 100000" / "bawah 100 ribu")
        $maxPrice = $this->extractMaxPrice($query);
        if ($maxPrice !== null) {
            $equipmentQuery->where('rental_price_per_day', '<=', $maxPrice);
        }

        $results = $equipmentQuery->get();

        // Buat pesan AI yang kontekstual
        $aiMessage = $this->buildAiMessage($query, $results->count(), $maxPrice);

        return view('Ai search', compact('results', 'query', 'aiMessage'));
    }

    /**
     * Cek apakah query mengandung salah satu kata petunjuk harga.
     */
    private function containsPriceHint(string $query, string ...$hints): bool
    {
        $lower = strtolower($query);
        foreach ($hints as $hint) {
            if (str_contains($lower, $hint)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Ekstrak batas harga maksimum dari query (misal: "di bawah 50000", "bawah 100 ribu").
     */
    private function extractMaxPrice(string $query): ?int
    {
        // Cocokkan pola seperti "di bawah 50000" atau "bawah 100 ribu"
        if (preg_match('/(?:di\s+)?bawah\s+(\d[\d\.]*)\s*(ribu|rb)?/i', $query, $matches)) {
            $amount = (int) str_replace('.', '', $matches[1]);
            if (!empty($matches[2])) {
                $amount *= 1000;
            }
            return $amount;
        }

        // Cocokkan pola seper "max 75rb" atau "maksimal 75000"
        if (preg_match('/maks(?:imal)?\s+(\d[\d\.]*)\s*(ribu|rb)?/i', $query, $matches)) {
            $amount = (int) str_replace('.', '', $matches[1]);
            if (!empty($matches[2])) {
                $amount *= 1000;
            }
            return $amount;
        }

        return null;
    }

    /**
     * Buat pesan ringkasan AI berdasarkan hasil pencarian.
     */
    private function buildAiMessage(string $query, int $count, ?int $maxPrice): string
    {
        if ($count === 0) {
            return "Saya tidak menemukan peralatan yang cocok dengan \"$query\". Coba gunakan kata kunci yang lebih umum, misalnya nama jenis alat atau kategorinya.";
        }

        $priceNote = $maxPrice
            ? " dengan harga maksimal Rp " . number_format($maxPrice, 0, ',', '.')
            : '';

        return "Berdasarkan pencarian \"$query\"{$priceNote}, saya menemukan {$count} peralatan yang paling relevan. Hasil diurutkan berdasarkan relevansi kata kunci yang Anda masukkan.";
    }
}
