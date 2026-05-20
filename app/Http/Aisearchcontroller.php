<?php

namespace App\Http\Controllers;

use App\AI\Agents\SmartSearchAgent;
use App\Models\Equipment;
use Illuminate\Http\Request;

class AiSearchController extends Controller

{
    public function __construct(
        protected SmartSearchAgent $agent
    ) {}

    public function index()
    {
        return view('equipment.ai-search', [
            'query'     => null,
            'results'   => null,
            'aiMessage' => null,
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:500',
        ]);

        $query = $request->input('query');

        try {
            // Jalankan AI agent
            $result = $this->agent->search($query);

            $matchedIds = $result['matched_ids'];
            $aiMessage  = $result['message'];

            $results = empty($matchedIds)
                ? collect()
                : Equipment::with('category')->whereIn('id', $matchedIds)->get();

        } catch (\Exception $e) {
            // Fallback: pencarian biasa jika agent gagal
            $results   = Equipment::with('category')
                ->where('equipment_name', 'like', "%{$query}%")
                ->orWhereHas('category', fn($q) => $q->where('category_name', 'like', "%{$query}%"))
                ->get();
            $aiMessage = 'Pencarian AI tidak tersedia saat ini. Menampilkan hasil pencarian biasa.';
        }

        return view('equipment.ai-search', compact('query', 'results', 'aiMessage'));
    }
}