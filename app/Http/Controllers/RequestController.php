<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use File;
use Alert;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use App\Models\OrderStatus;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oders = Order::where('buyer_id', Auth::user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('pages.dashboard.request.index', compact('orders'));
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
        $order = Order::where('id', $id)->first();
        return view('pages.dashboard.request.detail', compact('order'));
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


    public function approve(string $id): RedirectResponse
    {
        // get data order from order table, kalo datanya udah di ambil, maka kita bisa panggil object array nya seperti $order['id']
        $order = Order::where('id', $id)->first();

        // update order
        $order = Order::find($order['id']);
        $order->status_id = 1;
        $order->save();

        toast()->success('Approve has been updated');
        return redirect()->route('request.index');
    }
}
