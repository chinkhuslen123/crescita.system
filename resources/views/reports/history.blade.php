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
        --border-light: #E4DACB;
        --dash: #D9CFC1;
    }

    .rh-page * { box-sizing: border-box; }

    .rh-page {
        min-height: 100vh;
        background: var(--bg);
        font-family: 'Inter', sans-serif;
    }

    .rh-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 40px 24px;
    }

    .rh-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .rh-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: transparent;
        border: 2px solid #3A332C;
        color: var(--card);
        font-size: 14px;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 999px;
        text-decoration: none;
        transition: .2s;
    }

    .rh-back:hover { background: rgba(255,255,255,.1); }

    .rh-topbar-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .rh-print-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--ink);
        color: #fff;
        border: none;
        font-size: 14px;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 999px;
        cursor: pointer;
        box-shadow: 0 8px 18px rgba(0,0,0,.3);
        transition: .2s;
    }

    .rh-print-btn:hover { filter: brightness(1.2); }

    .rh-close-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--red);
        color: #fff;
        border: none;
        font-size: 14px;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 999px;
        cursor: pointer;
        box-shadow: 0 8px 18px rgba(0,0,0,.3);
        transition: .2s;
    }

    .rh-close-btn:hover { filter: brightness(1.1); }

    .rh-header {
        margin-bottom: 20px;
    }

    .rh-eyebrow {
        text-transform: uppercase;
        letter-spacing: .2em;
        font-size: 12px;
        font-weight: 600;
        color: var(--amber);
        margin: 0;
    }

    .rh-title {
        font-family: 'Fraunces', serif;
        font-size: 32px;
        font-weight: 600;
        color: #fff;
        margin: 4px 0 0;
    }

    .rh-alert {
        padding: 14px 18px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 24px;
    }

    .rh-alert-success { background: rgba(63,125,88,.2); color: #8FD1A5; border: 1px solid var(--green); }
    .rh-alert-error { background: rgba(181,71,58,.2); color: #E39B90; border: 1px solid var(--red); }

    .rh-closed-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(63,125,88,.15);
        color: #8FD1A5;
        border: 1px solid var(--green);
        font-size: 13px;
        font-weight: 700;
        padding: 10px 18px;
        border-radius: 999px;
        margin-bottom: 24px;
    }

    .rh-date-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #2B2320;
        border-radius: 14px;
        padding: 12px 16px;
        margin-bottom: 28px;
    }

    .rh-date-nav {
        background: transparent;
        border: 2px solid #3A332C;
        color: var(--card);
        width: 38px;
        height: 38px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        transition: .2s;
        flex-shrink: 0;
    }

    .rh-date-nav:hover { border-color: var(--amber); color: var(--amber); }

    .rh-date-form {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1;
    }

    .rh-date-input {
        font-family: 'JetBrains Mono', monospace;
        font-size: 14px;
        font-weight: 600;
        color: var(--ink);
        background: var(--card);
        border: none;
        border-radius: 10px;
        padding: 10px 14px;
    }

    .rh-date-submit {
        background: var(--amber);
        color: #fff;
        border: none;
        font-weight: 700;
        font-size: 14px;
        padding: 10px 20px;
        border-radius: 10px;
        cursor: pointer;
        transition: .2s;
    }

    .rh-date-submit:hover { filter: brightness(1.1); }

    .rh-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 14px;
        margin-bottom: 32px;
    }

    .rh-summary-card {
        background: var(--card);
        border-radius: 16px;
        padding: 18px 20px;
        box-shadow: 0 10px 22px rgba(0,0,0,.25);
    }

    .rh-summary-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: var(--muted);
        margin: 0 0 6px;
    }

    .rh-summary-value {
        font-family: 'Fraunces', serif;
        font-size: 24px;
        font-weight: 700;
        color: var(--ink);
        margin: 0;
    }

    .rh-summary-card.is-total .rh-summary-value { color: #C05A3E; }

    .rh-table-wrap {
        background: var(--card);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 16px 32px rgba(0,0,0,.3);
    }

    .rh-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .rh-table thead th {
        background: #2B2320;
        color: #fff;
        text-align: left;
        padding: 14px 20px;
        font-weight: 600;
        font-size: 13px;
    }

    .rh-table thead th.rh-right { text-align: right; }

    .rh-table tbody td {
        padding: 14px 20px;
        border-top: 1px solid var(--border-light);
        color: var(--ink);
    }

    .rh-table tbody tr:hover { background: rgba(208,138,62,.06); }

    .rh-table .rh-mono {
        font-family: 'JetBrains Mono', monospace;
        font-size: 13px;
        color: var(--muted);
    }

    .rh-table .rh-amount {
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700;
        text-align: right;
        color: var(--ink);
    }

    .rh-payment-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 600;
        color: var(--muted);
    }

    .rh-empty {
        padding: 60px 20px;
        text-align: center;
        color: var(--muted);
    }

    .rh-empty .rh-emoji { font-size: 40px; margin-bottom: 10px; }

    .rh-footer-total {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 20px;
        border-top: 2px dashed var(--dash);
    }

    .rh-footer-total-label {
        text-transform: uppercase;
        letter-spacing: .15em;
        font-size: 12px;
        font-weight: 700;
        color: var(--muted);
    }

    .rh-footer-total-amount {
        font-family: 'Fraunces', serif;
        font-size: 26px;
        font-weight: 700;
        color: #C05A3E;
    }

    /* --- PRINT --- */
    @media print {

        .rh-page { background: #fff; }

        .rh-back,
        .rh-date-bar,
        .rh-print-btn,
        .rh-close-btn {
            display: none !important;
        }

        .rh-title, .rh-eyebrow { color: #000 !important; }

        .rh-summary-card,
        .rh-table-wrap {
            box-shadow: none !important;
            border: 1px solid #ccc;
        }

        .rh-table thead th {
            background: #eee !important;
            color: #000 !important;
        }
    }
</style>

<div class="rh-page">

    <div class="rh-container">

        <div class="rh-topbar">

            <a href="{{ route('dashboard') }}" class="rh-back">
                ← Dashboard
            </a>

            <div class="rh-topbar-actions">

                @if(!$closing)

                <form method="POST" action="{{ route('reports.close-day') }}"
                    onsubmit="return confirm('{{ $date }} өдрийг хааж, тооцоог түгээмэл болгох уу? Дахин нээх боломжгүй.');">
                    @csrf
                    <input type="hidden" name="date" value="{{ $date }}">
                    <button type="submit" class="rh-close-btn">
                        🔒 Өдрийг хаах
                    </button>
                </form>

                @endif

                <button type="button" class="rh-print-btn" onclick="window.print()">
                    🖨 Хэвлэх
                </button>

            </div>

        </div>

        <div class="rh-header">
            <p class="rh-eyebrow">Тайлан</p>
            <h1 class="rh-title">📊 Орлогын түүх</h1>
        </div>

        @if(session('success'))
        <div class="rh-alert rh-alert-success">✅ {{ session('success') }}</div>
        @endif

        @if(session('error'))
        <div class="rh-alert rh-alert-error">⚠️ {{ session('error') }}</div>
        @endif

        @if($closing)
        <div class="rh-closed-badge">
            ✅ Хаагдсан — {{ $closing->closed_at->format('Y-m-d H:i') }}
        </div>
        @endif

        <div class="rh-date-bar">

            <button type="button" class="rh-date-nav" onclick="goToDate(-1)">‹</button>

            <form method="GET" class="rh-date-form">
                <input type="date" name="date" value="{{ $date }}" class="rh-date-input">
                <button type="submit" class="rh-date-submit">Харах</button>
            </form>

            <button type="button" class="rh-date-nav" onclick="goToDate(1)">›</button>

        </div>

        @php
            $displayTotal = $closing ? $closing->total_amount : $total;
            $displayCount = $closing ? $closing->total_orders : $orders->count();
            $displayCash = $closing ? $closing->cash_amount : $orders->where('payment_type','cash')->sum('total_price');
            $displayCard = $closing ? $closing->card_amount : $orders->where('payment_type','card')->sum('total_price');
            $displayQpay = $closing ? $closing->qpay_amount : $orders->where('payment_type','qpay')->sum('total_price');
        @endphp

        <div class="rh-summary">

            <div class="rh-summary-card is-total">
                <p class="rh-summary-label">Нийт орлого</p>
                <p class="rh-summary-value">{{ number_format($displayTotal) }} ₮</p>
            </div>

            <div class="rh-summary-card">
                <p class="rh-summary-label">Захиалгын тоо</p>
                <p class="rh-summary-value">{{ $displayCount }}</p>
            </div>

            <div class="rh-summary-card">
                <p class="rh-summary-label">💵 Бэлэн</p>
                <p class="rh-summary-value">{{ number_format($displayCash) }} ₮</p>
            </div>

            <div class="rh-summary-card">
                <p class="rh-summary-label">💳 Карт</p>
                <p class="rh-summary-value">{{ number_format($displayCard) }} ₮</p>
            </div>

            <div class="rh-summary-card">
                <p class="rh-summary-label">📱 QPay</p>
                <p class="rh-summary-value">{{ number_format($displayQpay) }} ₮</p>
            </div>

        </div>

        <div class="rh-table-wrap">

            @if($orders->count() > 0)

            <table class="rh-table">

                <thead>
                    <tr>
                        <th>Ширээ</th>
                        <th>Эхэлсэн цаг</th>
                        <th>Дууссан цаг</th>
                        <th>Төлбөр</th>
                        <th class="rh-right">Орлого</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($orders as $order)

                    <tr>

                        <td>{{ $order->table->name }}</td>

                        <td class="rh-mono">{{ $order->start_time }}</td>

                        <td class="rh-mono">{{ $order->end_time }}</td>

                        <td>
                            <span class="rh-payment-badge">
                                @if($order->payment_type == 'cash')
                                    💵 Бэлэн
                                @elseif($order->payment_type == 'card')
                                    💳 Карт
                                @elseif($order->payment_type == 'qpay')
                                    📱 QPay
                                @else
                                    —
                                @endif
                            </span>
                        </td>

                        <td class="rh-amount">{{ number_format($order->total_price) }} ₮</td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            <div class="rh-footer-total">
                <span class="rh-footer-total-label">Нийт</span>
                <span class="rh-footer-total-amount">{{ number_format($displayTotal) }} ₮</span>
            </div>

            @else

            <div class="rh-empty">
                <div class="rh-emoji">🗒️</div>
                <p>Энэ өдөр хаагдсан захиалга бүртгэгдээгүй байна.</p>
            </div>

            @endif

        </div>

    </div>

</div>

<script>

function goToDate(offsetDays)
{
    const input = document.querySelector('.rh-date-input');
    const current = new Date(input.value + 'T00:00:00');

    current.setDate(current.getDate() + offsetDays);

    const y = current.getFullYear();
    const m = String(current.getMonth() + 1).padStart(2, '0');
    const d = String(current.getDate()).padStart(2, '0');

    window.location.href = window.location.pathname + '?date=' + y + '-' + m + '-' + d;
}

</script>

</x-app-layout>