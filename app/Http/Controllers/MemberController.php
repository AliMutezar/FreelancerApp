<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use Alert;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\DetailUser;
use App\Models\ExperienceUser;
use App\Models\Order;
use App\Models\Service;
use App\Models\OrderStatus;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $order = Order::where('freelancer_id', Auth::user()->id)->get();
        
        
        $progress   = Order::where('freelancer_id', Auth::user()->id)
                            ->where('order_status_id', 2)->count();

        $completed  = Order::where('freelancer_id', Auth::user()->id)
                            ->where('order_status_id', 1)->count();

        $freelancer = Order::where('freelancer_id', Auth::user()->id)
                            ->where('order_status_id', 2)
                            ->distinct('freelancer_id')->count();

        return view('pages.dashboard.index', compact('order', 'progress', 'completed', 'freelancer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return abort(404);
    }
}
