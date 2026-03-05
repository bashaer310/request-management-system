<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === UserRole::MANAGER) {
            $requests = Request::where('status', 'pending')
                ->with(['creator', 'approver'])
                ->latest()
                ->get();
        } else {
            $requests = Request::where('created_by', $user->id)
                ->with(['approver'])
                ->latest()
                ->get();
        }

        return response()->json([
            'success' => true,
            'message' => 'تم جلب الطلبات بنجاح',
            'count' => $requests->count(),
            'data' => $requests->map(fn($r) => [
                'id' => $r->id,
                'title' => $r->title,
                'description' => $r->description,
                'status' => $r->status->value,
                'status_label' => $r->status->label(),
                'creator' => [
                    'id' => $r->creator->id,
                    'name' => $r->creator->name,
                    'email' => $r->creator->email,
                ],
                'approver' => $r->approver ? [
                    'id' => $r->approver->id,
                    'name' => $r->approver->name,
                ] : null,
                'created_at' => $r->created_at->toIso8601String(),
                'updated_at' => $r->updated_at->toIso8601String(),
            ]),
        ]);
    }
}
