<x-app-layout>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --bg: #1C1917;
        --card: #FDF8F0;
        --ink: #2B2320;
        --muted: #8A8074;
        --amber: #D08A3E;
        --green: #3F7D58;
        --red: #B5473A;
        --purple: #6C4F9C;
        --blue: #3D6FA8;
        --border: #3A332C;
    }

    .db-page * { box-sizing: border-box; }

    .db-page {
        min-height: 100vh;
        background: var(--bg);
        font-family: 'Inter', sans-serif;
    }

    .db-container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 40px 24px;
    }

    .db-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 44px;
    }

    .db-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #fff;
        padding: 14px 22px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        box-shadow: 0 8px 18px rgba(0,0,0,.3);
        transition: transform .15s, filter .15s;
    }

    .db-action-btn:hover {
        filter: brightness(1.1);
        transform: translateY(-1px);
    }

    .db-action-history { background: var(--purple); }
    .db-action-table   { background: var(--green); }
    .db-action-product { background: var(--blue); }

    .db-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
    }

    .db-heading h2 {
        font-family: 'Fraunces', serif;
        font-size: 26px;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }

    .db-heading .db-count {
        font-family: 'JetBrains Mono', monospace;
        font-size: 13px;
        color: var(--muted);
    }

    .db-table-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 150px));
        gap: 20px;
    }

    .db-table-tile {
        width: 150px;
        height: 150px;
        border-radius: 18px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        text-align: center;
        text-decoration: none;
        color: #fff;
        box-shadow: 0 10px 24px rgba(0,0,0,.35);
        transition: transform .15s, box-shadow .15s;
    }

    .db-table-tile:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 28px rgba(0,0,0,.45);
    }

    .db-table-tile.is-busy {
        background: linear-gradient(160deg, #C4573F, var(--red));
    }

    .db-table-tile.is-empty {
        background: linear-gradient(160deg, #4A9269, var(--green));
    }

    .db-tile-emoji { font-size: 26px; line-height: 1; }

    .db-tile-name {
        font-weight: 700;
        font-size: 17px;
        font-family: 'Fraunces', serif;
    }

    .db-tile-status {
        font-size: 12px;
        font-weight: 600;
        opacity: .9;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .db-tile-timer {
        margin-top: 4px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 13px;
        font-weight: 600;
        background: rgba(0,0,0,.2);
        padding: 3px 8px;
        border-radius: 999px;
    }

    .db-empty-state {
        color: var(--muted);
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        padding: 20px 0;
    }
</style>

<div class="db-page">

    <div class="db-container">

        <div class="db-actions">

            <a href="{{ route('reports.history') }}" class="db-action-btn db-action-history">
                📊 Орлогын түүх
            </a>

            <a href="{{ route('tables.create') }}" class="db-action-btn db-action-table">
                🪑 + Шинэ ширээ
            </a>

            <a href="{{ route('products.create') }}" class="db-action-btn db-action-product">
                📦 + Шинэ бараа
            </a>

        </div>

        <div class="db-heading">
            <h2>🪑 Ширээнүүд</h2>
            <span class="db-count">{{ $tables->count() }}</span>
        </div>

        <div class="db-table-grid">

            @forelse($tables as $table)

                @php
                    $order = $table->orders->whereNull('payment_type')->first();
                @endphp

                @if($order)

                <!-- ЗАВГҮЙ ШИРЭЭ -->

                <a href="{{ route('orders.show',$order) }}" class="db-table-tile is-busy">

                    <div class="db-tile-emoji">🔴</div>
                    <div class="db-tile-name">{{ $table->name }}</div>
                    <div class="db-tile-status">Завгүй</div>

                    <div class="db-tile-timer">
                        ⏱
                        <span class="timer" data-start="{{ strtotime($order->start_time) }}">
                            00:00:00
                        </span>
                    </div>

                </a>

                @else

                <!-- СУЛ ШИРЭЭ -->

                <a href="{{ route('tables.order',$table) }}" class="db-table-tile is-empty">

                    <div class="db-tile-emoji">🟢</div>
                    <div class="db-tile-name">{{ $table->name }}</div>
                    <div class="db-tile-status">Сул</div>

                </a>

                @endif

            @empty

                <p class="db-empty-state">Одоогоор бүртгэлтэй ширээ байхгүй байна.</p>

            @endforelse

        </div>

    </div>

</div>

<script>

function updateTimers()
{
    document.querySelectorAll('.timer').forEach(function (timer) {

        let start = parseInt(timer.dataset.start);
        let now = Math.floor(Date.now() / 1000);
        let diff = now - start;

        let hours = Math.floor(diff / 3600);
        let minutes = Math.floor((diff % 3600) / 60);
        let seconds = diff % 60;

        timer.innerHTML =
            String(hours).padStart(2, '0') + ":" +
            String(minutes).padStart(2, '0') + ":" +
            String(seconds).padStart(2, '0');

    });
}

updateTimers();
setInterval(updateTimers, 1000);

</script>

</x-app-layout>