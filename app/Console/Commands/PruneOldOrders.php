<?php

namespace App\Console\Commands;

use App\Models\DailyClosing;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PruneOldOrders extends Command
{
    protected $signature = 'orders:prune {--days=30} {--dry-run}';

    protected $description = 'Хаагдсан (daily_closings-д нэгтгэгдсэн) хуучин захиалгуудыг устгаж database цэвэрлэнэ';

    public function handle(): int
    {
        $days = (int) $this->option('days');
        $cutoff = now()->subDays($days)->toDateString();

        $closedDates = DailyClosing::where('date', '<', $cutoff)
            ->pluck('date')
            ->map(fn ($d) => $d->format('Y-m-d'))
            ->all();

        if (empty($closedDates)) {
            $this->info('Устгах шаардлагатай хаагдсан өдөр алга.');
            return self::SUCCESS;
        }

        $query = Order::whereNotNull('payment_type')
            ->whereIn(DB::raw('DATE(end_time)'), $closedDates);

        $count = $query->count();

        if ($count === 0) {
            $this->info('Устгах захиалга алга.');
            return self::SUCCESS;
        }

        if ($this->option('dry-run')) {
            $this->info("{$count} захиалга устгагдах байсан (dry-run — бодитоор устгаагүй).");
            return self::SUCCESS;
        }

        $deleted = 0;

        $query->chunkById(200, function ($orders) use (&$deleted) {
            foreach ($orders as $order) {
                $order->items()->delete();
                $order->delete();
                $deleted++;
            }
        });

        $this->info("{$deleted} захиалга устгагдлаа. Өдрийн нэгтгэсэн тооцоо (daily_closings) хэвээр үлдсэн.");

        return self::SUCCESS;
    }
}