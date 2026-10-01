<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BoardMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class BoardMemberController extends Controller
{
    public function index(): JsonResponse
    {
        $members = Cache::remember('api_board_members', 60, function () {
            return BoardMember::where('is_published', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn($m) => [
                    'id' => (int) $m->id,
                    'role' => (string) $m->role,
                    'roleLabel' => (string) $m->role_label,
                    'name' => (string) $m->name,
                    'desc' => (string) ($m->description ?? ''),
                    'featured' => (bool) $m->is_featured,
                ])
                ->toArray();
        });

        return response()->json($members)
            ->header('Cache-Control', 'public, max-age=60');
    }
}
