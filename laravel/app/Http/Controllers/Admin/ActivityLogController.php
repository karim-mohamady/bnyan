<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(Request $request): View
    {
        $query = ActivityLog::latest('id');

        if ($request->filled('action') && $request->input('action') !== 'all') {
            $query->where('action', $request->input('action'));
        }

        if ($request->filled('entity') && $request->input('entity') !== 'all') {
            $query->where('entity', $request->input('entity'));
        }

        if ($request->filled('q')) {
            $query->where('summary', 'like', '%' . $request->input('q') . '%');
        }

        $logs = $query->paginate(30);

        return view('admin.activity-logs.index', compact('logs'));
    }
}
