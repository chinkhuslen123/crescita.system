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
        --border: #3A332C;
        --border-light: #E4DACB;
        --dash: #D9CFC1;
    }

    .op-page * { box-sizing: border-box; }

    .op-page {
        min-height: 100vh;
        background: var(--bg);
        font-family: 'Inter', sans-serif;
    }

    .op-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 24px;
    }

    .op-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 40px;
    }

    .op-eyebrow {
        text-transform: uppercase;
        letter-spacing: .2em;
        font-size: 12px;
        font-weight: 600;
        color: var(--amber);
        margin: 0;
    }

    .op-title {
        font-family: 'Fraunces', serif;
        font-size: 36px;
        font-weight: 600;
        color: #fff;
        margin: 4px 0 0;
    }

    .op-back {
        background: transparent;
        border: 2px solid var(--border);
        color: var(--card);
        font-size: 14px;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 999px;
        text-decoration: none;
        transition: .2s;
        white-space: nowrap;
    }

    .op-back:hover { background: rgba(255,255,255,.1); }

    .op-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 32px;
        align-items: start;
    }

    @media (max-width: 1024px) {
        .op-layout { grid-template-columns: 1fr; }
        .op-ticket-wrap { position: static !important; }
    }

    .op-tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 32px;
        overflow-x: auto;
        padding-bottom: 4px;
    }

    .op-tab {
        flex-shrink: 0;
        background: #2B2320;
        color: #B5AA9A;
        border: 2px solid var(--border);
        font-weight: 600;
        font-size: 14px;
        padding: 10px 20px;
        border-radius: 999px;
        cursor: pointer;
        transition: .2s;
        white-space: nowrap;
    }

    .op-tab:hover { border-color: var(--amber); color: var(--card); }

    .op-tab.is-active {
        background: var(--amber);
        border-color: var(--amber);
        color: var(--bg);
    }

    .op-tab .op-count {
        font-family: 'JetBrains Mono', monospace;
        font-size: 12px;
        opacity: .7;
        margin-left: 4px;
    }

    .op-panel.op-hidden { display: none; }

    .op-menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 16px;
    }

    .op-product-card {
        background: var(--card);
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,.25);
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .op-product-name {
        font-weight: 600;
        font-size: 18px;
        color: var(--ink);
    }

    .op-product-price {
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700;
        font-size: 18px;
        color: #C05A3E;
        margin-top: 4px;
    }

    .op-product-controls {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: auto;
    }

    .op-stepper {
        display: flex;
        align-items: center;
        border: 1px solid var(--border-light);
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .op-stepper button {
        width: 36px;
        height: 36px;
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
    }

    .op-stepper button.op-minus { background: var(--red); }
    .op-stepper button.op-plus { background: var(--green); }

    .op-stepper input {
        width: 48px;
        height: 36px;
        text-align: center;
        border: none;
        font-family: 'JetBrains Mono', monospace;
        font-weight: 600;
        color: var(--ink);
        -moz-appearance: textfield;
    }

    .op-stepper input:focus { outline: none; }

    .op-add-btn {
        flex: 1;
        background: var(--amber);
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        border: none;
        border-radius: 12px;
        padding: 10px 16px;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0,0,0,.2);
        transition: .2s;
    }

    .op-add-btn:hover { filter: brightness(1.1); }

    .op-ticket-wrap { position: sticky; top: 32px; }

    .op-ticket {
        border-radius: 4px 4px 0 0;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,.4);
    }

    .op-ticket-header {
        background: #2B2320;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .op-ticket-header h2 {
        font-family: 'Fraunces', serif;
        font-size: 20px;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }

    .op-ticket-header .op-num {
        font-family: 'JetBrains Mono', monospace;
        font-size: 12px;
        color: var(--muted);
    }

    .op-ticket-body { background: var(--card); }

    .op-line-items { padding: 20px 24px 8px; }

    .op-line-item {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        padding: 10px 0;
        border-top: 2px dashed var(--dash);
    }

    .op-line-item:first-child { border-top: none; }

    .op-line-name { font-weight: 600; font-size: 14px; color: var(--ink); }

    .op-line-meta {
        font-family: 'JetBrains Mono', monospace;
        font-size: 12px;
        color: var(--muted);
        margin-top: 2px;
    }

    .op-line-total {
        font-family: 'JetBrains Mono', monospace;
        font-weight: 600;
        font-size: 14px;
        color: var(--ink);
        white-space: nowrap;
    }

    .op-empty { padding: 40px 0; text-align: center; }
    .op-empty .op-emoji { font-size: 36px; margin-bottom: 8px; }
    .op-empty p { font-size: 14px; font-weight: 500; color: var(--muted); margin: 0; }

    .op-pending-item { background: rgba(208,138,62,.08); margin: 0 -24px; padding: 10px 24px; }
    .op-pending-item .op-line-name::after {
        content: 'шинэ';
        margin-left: 8px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: var(--amber);
        background: rgba(208,138,62,.15);
        padding: 2px 6px;
        border-radius: 6px;
    }

    .op-remove-btn {
        background: none;
        border: none;
        color: var(--red);
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        line-height: 1;
        padding: 4px;
    }

    .op-ticket-footer {
        padding: 12px 24px 24px;
        border-top: 2px dashed var(--dash);
    }

    .op-total-row {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .op-total-label {
        text-transform: uppercase;
        letter-spacing: .15em;
        font-size: 12px;
        font-weight: 700;
        color: var(--muted);
    }

    .op-total-amount {
        font-family: 'Fraunces', serif;
        font-size: 30px;
        font-weight: 700;
        color: #C05A3E;
    }

    .op-confirm-btn {
        width: 100%;
        background: var(--green);
        color: #fff;
        font-weight: 700;
        font-size: 16px;
        border: none;
        border-radius: 12px;
        padding: 14px;
        cursor: pointer;
        box-shadow: 0 10px 20px rgba(0,0,0,.3);
        transition: .2s;
    }

    .op-confirm-btn:hover { filter: brightness(1.1); }

    .op-confirm-btn:disabled {
        background: #4A4238;
        color: #8A8074;
        cursor: not-allowed;
        box-shadow: none;
    }

    .op-ticket-edge {
        height: 14px;
        background-image: radial-gradient(circle at 10px 0, var(--bg) 10px, transparent 10px);
        background-size: 20px 14px;
        background-repeat: repeat-x;
        background-position: -4px 0;
    }

    .op-page button:focus-visible,
    .op-page a:focus-visible {
        outline: 2px solid var(--amber);
        outline-offset: 2px;
    }
</style>

<div class="op-page">

    <div class="op-container">

        <!-- Header -->
        <div class="op-header">

            <div>
                <p class="op-eyebrow">Ширээний захиалга</p>
                <h1 class="op-title">🪑 {{ $order->table->name }}</h1>
            </div>

            <a href="{{ route('orders.show',$order) }}" class="op-back">
                ← Буцах
            </a>

        </div>

        <div class="op-layout">

            <!-- MENU / PRODUCTS -->
            <div>

                <!-- CATEGORY TABS -->
                <div class="op-tabs">

                    @foreach($categories as $category)

                    <button
                        type="button"
                        onclick="showCategory({{ $category->id }})"
                        data-category-tab="{{ $category->id }}"
                        class="op-tab {{ $loop->first ? 'is-active' : '' }}">
                        {{ $loop->first ? '🍔 ' : '' }}{{ $category->name }}
                        <span class="op-count">{{ $category->products->count() }}</span>
                    </button>

                    @endforeach

                </div>

                @foreach($categories as $category)

                <div
                    id="category-panel-{{ $category->id }}"
                    class="op-panel {{ $loop->first ? '' : 'op-hidden' }}">

                    <div class="op-menu-grid">

                        @foreach($category->products as $product)

                        <div
                            class="op-product-card"
                            data-product-id="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                            data-price="{{ $product->price }}">

                            <div>
                                <div class="op-product-name">{{ $product->name }}</div>
                                <div class="op-product-price">{{ number_format($product->price) }} ₮</div>
                            </div>

                            <div class="op-product-controls">

                                <div class="op-stepper">
                                    <button type="button" class="op-minus" onclick="decrease(this)">−</button>
                                    <input type="number" class="op-qty-input" value="1" min="1">
                                    <button type="button" class="op-plus" onclick="increase(this)">+</button>
                                </div>

                                <button type="button" class="op-add-btn" onclick="addToCart(this)">➕ Нэмэх</button>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                @endforeach

            </div>

            <!-- ORDER TICKET -->
            <div class="op-ticket-wrap">

                <div class="op-ticket">

                    <div class="op-ticket-header">
                        <h2>🧾 Захиалга</h2>
                        <span class="op-num">#{{ $order->id ?? '—' }}</span>
                    </div>

                    <div class="op-ticket-body">

                        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
                        <input type="hidden" id="base-total" value="{{ (float) $order->total_price }}">
                        <input type="hidden" id="store-product-url" value="{{ route('orders.store-product',$order) }}">

                        <div class="op-line-items" id="line-items" data-has-saved="{{ $order->items->count() ? '1' : '0' }}">

                            @forelse($order->items as $item)

                            <div class="op-line-item">

                                <div>
                                    <div class="op-line-name">{{ $item->product->name }}</div>
                                    <div class="op-line-meta">{{ $item->quantity }} × {{ number_format($item->price) }} ₮</div>
                                </div>

                                <div class="op-line-total">{{ number_format($item->price * $item->quantity) }} ₮</div>

                            </div>

                            @empty

                            <div class="op-empty" id="empty-state">
                                <div class="op-emoji">🛒</div>
                                <p>Захиалга хоосон байна</p>
                            </div>

                            @endforelse

                            <div id="pending-cart"></div>

                        </div>

                        <div class="op-ticket-footer">

                            <div class="op-total-row">
                                <span class="op-total-label">Нийт</span>
                                <span class="op-total-amount" id="total-amount">{{ number_format($order->total_price) }} ₮</span>
                            </div>

                            <button type="button" class="op-confirm-btn" id="confirm-btn" onclick="submitCart()" disabled>
                                ✔ Батлах
                            </button>

                        </div>

                    </div>

                </div>

                <div class="op-ticket-edge" style="filter: drop-shadow(0 -1px 0 var(--bg));"></div>

            </div>

        </div>

    </div>

</div>

<script>

function showCategory(categoryId)
{
    document.querySelectorAll('.op-panel').forEach(function (panel) {
        panel.classList.add('op-hidden');
    });

    document.getElementById('category-panel-' + categoryId).classList.remove('op-hidden');

    document.querySelectorAll('.op-tab').forEach(function (tab) {
        tab.classList.remove('is-active');
    });

    document.querySelector('[data-category-tab="' + categoryId + '"]').classList.add('is-active');
}

function increase(button)
{
    let input = button.closest('.op-product-card').querySelector('.op-qty-input');
    input.value = parseInt(input.value) + 1;
}

function decrease(button)
{
    let input = button.closest('.op-product-card').querySelector('.op-qty-input');
    let value = parseInt(input.value);

    if (value > 1) {
        input.value = value - 1;
    }
}

document.querySelectorAll('.op-qty-input').forEach(function (input) {
    input.addEventListener('change', function () {
        if (parseInt(this.value) < 1 || isNaN(parseInt(this.value))) {
            this.value = 1;
        }
    });
});

// --- Pending cart (items added but not yet sent to the server) ---

const cart = {};

function formatNumber(num)
{
    return new Intl.NumberFormat('en-US').format(Math.round(num));
}

function addToCart(button)
{
    const card = button.closest('.op-product-card');
    const productId = card.dataset.productId;
    const name = card.dataset.name;
    const price = parseFloat(card.dataset.price);
    const qtyInput = card.querySelector('.op-qty-input');
    const qty = parseInt(qtyInput.value) || 1;

    if (cart[productId]) {
        cart[productId].quantity += qty;
    } else {
        cart[productId] = { name: name, price: price, quantity: qty };
    }

    qtyInput.value = 1;

    renderCart();
}

function removeFromCart(productId)
{
    delete cart[productId];
    renderCart();
}

function renderCart()
{
    const container = document.getElementById('pending-cart');
    const keys = Object.keys(cart);

    container.innerHTML = keys.map(function (id) {
        const item = cart[id];
        const lineTotal = item.price * item.quantity;

        return '<div class="op-line-item op-pending-item">'
            + '<div><div class="op-line-name">' + item.name + '</div>'
            + '<div class="op-line-meta">' + item.quantity + ' × ' + formatNumber(item.price) + ' ₮</div></div>'
            + '<div style="display:flex; align-items:center; gap:10px;">'
            + '<div class="op-line-total">' + formatNumber(lineTotal) + ' ₮</div>'
            + '<button type="button" class="op-remove-btn" onclick="removeFromCart(\'' + id + '\')">×</button>'
            + '</div></div>';
    }).join('');

    const hasSaved = document.getElementById('line-items').dataset.hasSaved === '1';
    const emptyState = document.getElementById('empty-state');

    if (emptyState) {
        emptyState.classList.toggle('op-hidden', keys.length > 0 || hasSaved);
    }

    document.getElementById('confirm-btn').disabled = keys.length === 0;

    updateTotal();
}

function updateTotal()
{
    const baseTotal = parseFloat(document.getElementById('base-total').value) || 0;

    const pendingTotal = Object.values(cart).reduce(function (sum, item) {
        return sum + item.price * item.quantity;
    }, 0);

    document.getElementById('total-amount').textContent = formatNumber(baseTotal + pendingTotal) + ' ₮';
}

function submitCart()
{
    const keys = Object.keys(cart);
    if (keys.length === 0) return;

    const confirmBtn = document.getElementById('confirm-btn');
    confirmBtn.disabled = true;
    confirmBtn.textContent = 'Илгээж байна…';

    const token = document.getElementById('csrf-token').value;
    const url = document.getElementById('store-product-url').value;

    const requests = keys.map(function (id) {
        return fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ product_id: id, quantity: cart[id].quantity })
        });
    });

    Promise.all(requests)
        .then(function (responses) {
            const failed = responses.some(function (r) { return !r.ok; });
            if (failed) {
                throw new Error('One or more requests failed');
            }
            window.location.href = "{{ route('dashboard') }}";
        })
        .catch(function () {
            alert('Захиалга илгээхэд алдаа гарлаа. Дахин оролдоно уу.');
            confirmBtn.disabled = false;
            confirmBtn.textContent = '✔ Батлах';
        });
}

</script>

</x-app-layout>