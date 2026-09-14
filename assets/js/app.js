// Shared client-side behavior. No framework required.
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-confirm]').forEach(function (el) {
        el.addEventListener('click', function (event) {
            if (!window.confirm(el.getAttribute('data-confirm'))) {
                event.preventDefault();
            }
        });
    });

    var cost = document.getElementById('cost_price');
    var sell = document.getElementById('selling_price');
    var out = document.getElementById('marginOut');
    var hint = document.getElementById('marginHint');

    function calculateMargin() {
        if (!cost || !sell || !out || !hint) return;
        var c = parseFloat(cost.value);
        var s = parseFloat(sell.value);
        if (isNaN(c) || isNaN(s) || s <= 0) {
            out.textContent = '—';
            hint.textContent = '(enter both prices)';
            return;
        }
        var margin = ((s - c) / s) * 100;
        out.textContent = margin.toFixed(2) + '%';
        hint.textContent = margin < 0 ? '(loss!)' : margin < 10 ? '(low)' : margin > 50 ? '(high)' : '(ok)';
    }

    if (cost && sell) {
        cost.addEventListener('input', calculateMargin);
        sell.addEventListener('input', calculateMargin);
        calculateMargin();
    }
});
