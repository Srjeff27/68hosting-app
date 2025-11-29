<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Project;
use App\Services\DomainService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private DomainService $domainService;

    public function __construct(DomainService $domainService)
    {
        $this->domainService = $domainService;
    }

    /**
     * Show order creation form
     */
    public function create(Project $project)
    {
        // Verify ownership
        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if project already has an order
        if ($project->order) {
            return redirect()->route('orders.show', $project->order);
        }

        // Check status
        if ($project->status !== 'temp') {
            return redirect()->route('dashboard')
                ->withErrors(['error' => 'This project cannot create a new order']);
        }

        return view('orders.create', compact('project'));
    }

    /**
     * Store new order
     */
    public function store(Request $request, Project $project)
    {
        // Verify ownership
        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'domain_name' => 'required|string|min:3|max:63',
            'payment_proof' => 'required|image|max:5120', // 5MB
            'whatsapp_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $domainName = $request->domain_name;

        // Validate domain format
        $errors = $this->domainService->validate($domainName);
        if (!empty($errors)) {
            return back()->withErrors(['domain_name' => $errors]);
        }

        // Check availability
        $slug = $this->domainService->slugify($domainName);
        if (!$this->domainService->isAvailable($slug)) {
            return back()->withErrors([
                'domain_name' => 'This domain name is already taken'
            ]);
        }

        // Upload payment proof
        $proofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'project_id' => $project->id,
            'domain_name' => $slug,
            'amount' => 50000,
            'payment_proof' => $proofPath,
            'status' => 'pending',
            'whatsapp_number' => $request->whatsapp_number,
            'email' => $request->email,
        ]);

        // Update project
        $project->update([
            'domain_name' => $slug,
            'status' => 'waiting_payment',
        ]);

        Log::info('Order created', [
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'domain' => $slug,
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order created successfully! Waiting for admin verification.');
    }

    /**
     * Show single order
     */
    public function show(Order $order)
    {
        // Verify ownership
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    /**
     * List user's orders
     */
    public function index()
    {
        $orders = Auth::user()->orders()
            ->with('project')
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Check domain availability (AJAX)
     */
    public function checkDomain(Request $request)
    {
        $request->validate([
            'domain_name' => 'required|string',
        ]);

        $domainName = $request->domain_name;
        $errors = $this->domainService->validate($domainName);

        if (!empty($errors)) {
            return response()->json([
                'available' => false,
                'message' => implode(', ', $errors),
            ]);
        }

        $slug = $this->domainService->slugify($domainName);
        $available = $this->domainService->isAvailable($slug);

        return response()->json([
            'available' => $available,
            'message' => $available
                ? "✓ {$slug}.zone.id is available!"
                : "✗ {$slug}.zone.id is already taken",
            'slug' => $slug,
        ]);
    }
}
