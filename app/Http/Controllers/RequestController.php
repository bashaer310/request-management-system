<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\Notification;
use App\Enums\UserRole;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RequestController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user();

        if ($user->role === UserRole::MANAGER) {
            $requests = Request::where('status', 'pending')
                ->with(['creator', 'approver'])
                ->latest()
                ->paginate(15);
        } else {
            $requests = Request::where('created_by', $user->id)
                ->with(['approver'])
                ->latest()
                ->paginate(15);
        }

        return view('requests.index', ['requests' => $requests]);
    }



    public function show(Request $request)
    {
        $this->authorize('view', $request);
        return view('requests.show', ['request' => $request]);
    }

    public function create()
    {
        $this->authorize('create', Request::class);
        return view('requests.create');
    }

    public function store(HttpRequest $request)
    {
        $this->authorize('create', Request::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ]);

        Request::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'pending',
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('requests.index')
            ->with('success', 'request created');
    }


    public function approve(Request $request)
    {
        $this->authorize('approve', $request);

        $request->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
        ]);

        Notification::create([
            'user_id' => $request->created_by,
            'message' => "request approved: \"{$request->title}\"",
        ]);

        return redirect()->route('requests.index')
            ->with('success', 'approve request is done');
    }


    public function reject(Request $request)
    {
        $this->authorize('reject', $request);

        $request->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
        ]);

        Notification::create([
            'user_id' => $request->created_by,
            'message' => "request rejectd: \"{$request->title}\"",
        ]);

        return redirect()->route('requests.index')
            ->with('success', 'reject request is done');
    }
}
