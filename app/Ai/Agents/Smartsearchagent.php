<?php

namespace App\AI\Agents;

use App\Models\Equipment;
use Laravel\AI\Agents; // <-- Ini base class yang benar
use Laravel\AI\Concerns\HasTextResponses;

class SmartSearchAgent extends Agents // <-- Diubah meng-extends Agent
{
    use HasTextResponses;

    /**
     * Provider yang digunakan (dari config/ai.php)
     */
    protected string $provider = 'anthropic';

    /**
     * Model Anthropic yang digunakan
     */
    protected string $model = 'claude-sonnet-4-20250514';

    /**
     * Instruksi sistem untuk agent ini
     */
    public function instructions(): string
    {
        return <<<INSTRUCTIONS
Kamu adalah asisten pencarian peralatan rental bernama RentEase.
Tugasmu adalah membantu pengguna menemukan peralatan yang paling sesuai 
dengan kebutuhan mereka berdasarkan deskripsi bebas yang mereka berikan.

Analisis kebutuhan pengguna dengan cermat:
- Jenis peralatan yang dicari
- Budget atau rentang harga
- Jumlah orang / kapasitas
- Kondisi atau kegunaan spesifik

Balas HANYA dalam format JSON, tanpa teks lain:
{
  "matched_ids": [1, 2, 3],
  "message": "Pesan penjelasan singkat dalam Bahasa Indonesia (1-2 kalimat)."
}

Jika tidak ada yang cocok, kembalikan matched_ids sebagai [] dan jelaskan dalam message.
INSTRUCTIONS;
    }

    /**
     * Cari equipment berdasarkan query natural language
     *
     * @param  string  $query
     * @return array{ matched_ids: int[], message: string }
     */
    public function search(string $query): array
    {
        // Ambil semua equipment dari database
        $equipmentList = Equipment::with('category')->get()->map(fn($item) => [
            'id'             => $item->id,
            'nama'           => $item->equipment_name,
            'kategori'       => $item->category->category_name ?? '-',
            'harga_per_hari' => $item->rental_price_per_day,
            'status'         => $item->availability_status,
        ])->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $prompt = <<<PROMPT
Berikut daftar semua peralatan yang tersedia di sistem:

{$equipmentList}

Pengguna mencari: "{$query}"

Pilih peralatan yang paling relevan dan kembalikan hasilnya.
PROMPT;

        // Memanggil teks generasi dari package AI
        $raw = $this->text($prompt);

        // Bersihkan markdown code block jika ada
        $clean = preg_replace('/^```json\s*/i', '', trim($raw));
        $clean = preg_replace('/\s*
```$/', '', $clean);

        $parsed = json_decode($clean, true);

        if (! isset($parsed['matched_ids'], $parsed['message'])) {
            return [
                'matched_ids' => [],
                'message'     => 'AI tidak dapat memproses pencarian saat ini. Silakan coba lagi.',
            ];
        }

        return $parsed;
    }
}