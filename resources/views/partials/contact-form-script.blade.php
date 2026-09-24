<script>
(function () {
    var form = document.getElementById('contact-form');
    if (!form || !window.fetch) return;

    function clearErrors() {
        form.querySelectorAll('[data-error]').forEach(function (el) { el.remove(); });
    }

    function showPopup(text) {
        var overlay = document.createElement('div');
        overlay.className = 'fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4 transition-opacity duration-200 opacity-0';
        overlay.setAttribute('role', 'dialog');
        overlay.setAttribute('aria-modal', 'true');
        overlay.setAttribute('aria-labelledby', 'popup-title');
        overlay.innerHTML =
            '<div class="w-full max-w-sm scale-95 rounded-3xl bg-white p-8 text-center shadow-2xl transition-transform duration-200 dark:bg-[#1a1a1a]">' +
                '<div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-400">' +
                    '<svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>' +
                '</div>' +
                '<h3 id="popup-title" class="mt-5 font-serif text-2xl font-bold text-ink dark:text-[#e0e0e0]">Message Sent</h3>' +
                '<p class="mt-2 text-ink/70 dark:text-[#e0e0e0]/70"></p>' +
                '<button type="button" class="btn-lift mt-6 w-full rounded-xl bg-brand-blue-darker px-6 py-3 font-bold text-white hover:bg-brand-blue-dark">OK</button>' +
            '</div>';
        overlay.querySelector('p').textContent = text;
        var card = overlay.firstChild;
        var okBtn = overlay.querySelector('button');

        function close() {
            document.removeEventListener('keydown', onKey);
            overlay.classList.add('opacity-0');
            setTimeout(function () { overlay.remove(); }, 200);
        }
        function onKey(e) { if (e.key === 'Escape') close(); }

        okBtn.addEventListener('click', close);
        overlay.addEventListener('click', function (e) { if (e.target === overlay) close(); });
        document.addEventListener('keydown', onKey);
        document.body.appendChild(overlay);
        requestAnimationFrame(function () {
            overlay.classList.remove('opacity-0');
            card.classList.remove('scale-95');
            okBtn.focus({ preventScroll: true });
        });
    }

    function showStatus(text, ok) {
        if (ok) return showPopup(text);
        var toast = document.createElement('div');
        toast.setAttribute('role', ok ? 'status' : 'alert');
        toast.className = 'fixed right-4 top-4 z-[100] flex max-w-[calc(100vw-2rem)] items-start gap-3 rounded-xl px-5 py-4 text-sm font-semibold text-white shadow-2xl transition duration-300 translate-x-8 opacity-0 sm:right-6 sm:top-6 sm:max-w-sm ' + (ok ? 'bg-emerald-600' : 'bg-brand-red');
        toast.innerHTML = '<svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' + (ok ? '<path d="M20 6 9 17l-5-5"/>' : '<circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/>') + '</svg><span></span>';
        toast.querySelector('span').textContent = text;
        document.body.appendChild(toast);
        requestAnimationFrame(function () { toast.classList.remove('translate-x-8', 'opacity-0'); });
        setTimeout(function () {
            toast.classList.add('translate-x-8', 'opacity-0');
            setTimeout(function () { toast.remove(); }, 300);
        }, 5000);
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        clearErrors();
        var btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;

        fetch(form.action, {
            method: 'POST',
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            body: new FormData(form)
        }).then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (data) {
                if (res.ok) {
                    form.reset();
                    showStatus(data.message, true);
                } else if (res.status === 422 && data.errors) {
                    Object.keys(data.errors).forEach(function (field) {
                        var input = form.elements[field];
                        if (!input) return;
                        var span = document.createElement('span');
                        span.setAttribute('data-error', '');
                        span.className = 'mt-1 block text-sm text-red-600 dark:text-red-400';
                        span.textContent = data.errors[field][0];
                        input.parentNode.appendChild(span);
                    });
                } else {
                    showStatus(res.status === 429 ? 'Too many attempts. Please wait a minute and try again.' : 'Something went wrong. Please try again.', false);
                }
            });
        }).catch(function () {
            showStatus('Network error. Please try again.', false);
        }).then(function () {
            btn.disabled = false;
        });
    });
})();
</script>
