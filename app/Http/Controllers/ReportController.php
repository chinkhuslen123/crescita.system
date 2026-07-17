<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DailyClosing;

class ReportController extends Controller
{
    public function history(Request $request)
{
    $orders = Order::with('table')
        ->whereNotNull('payment_type')
        ->orderBy('end_time', 'desc')
        ->get();

    $total = $orders->sum('total_price');

    $date = $request->date ?? now()->format('Y-m-d');

    $closing = DailyClosing::where('date', $date)->first();

    return view(
        'reports.history',
        compact('orders', 'total', 'date', 'closing')
    );
}
    public function closeDay(Request $request)
    {
        $date = $request->date ?? today()->format('Y-m-d');

        // Нэг өдөрт зөвхөн нэг л удаа хаагдана
        if (DailyClosing::where('date', $date)->exists()) {
            return redirect()
                ->route('reports.history', ['date' => $date])
                ->with('error', 'Энэ өдөр аль хэдийн хаагдсан байна.');
        }

        $orders = Order::whereNotNull('payment_type')
            ->whereDate('end_time', $date)
            ->get();

        DailyClosing::create([
            'date' => $date,
            'total_orders' => $orders->count(),
            'total_amount' => $orders->sum('total_price'),
            'cash_amount' => $orders->where('payment_type', 'cash')->sum('total_price'),
            'card_amount' => $orders->where('payment_type', 'card')->sum('total_price'),
            'qpay_amount' => $orders->where('payment_type', 'qpay')->sum('total_price'),
            'closed_at' => now(),
        ]);

        return redirect()
            ->route('reports.history', ['date' => $date])
            ->with('success', 'Өдрийн тооцоо хаагдлаа.');
    }
}
