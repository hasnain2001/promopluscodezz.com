document.addEventListener('DOMContentLoaded', function() {
    // Store filter functionality
    const storeSelect = document.getElementById('storeSelect');
    const tablecontents = document.getElementById('tablecontents');
    const couponCount = document.getElementById('couponCount');
    const resetFilter = document.getElementById('resetFilter');

    storeSelect.addEventListener('change', function() {
        const storeId = this.value;
        const url = "{{ route('admin.coupon.index') }}";
        const params = new URLSearchParams();

        if (storeId) {
            params.append('store_id', storeId);
        }

        // Show loading state
        tablecontents.innerHTML = `
            <tr>
                <td colspan="9" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 mb-0">Loading coupons...</p>
                </td>
            </tr>
        `;

        fetch(`${url}?${params.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            tablecontents.innerHTML = data.html;
            couponCount.textContent = document.querySelectorAll('#tablecontents tr[data-id]').length;

            // Initialize tooltips for new content
            if (window.bootstrap && window.bootstrap.Tooltip) {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            tablecontents.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center text-danger py-4">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                        <p class="mb-0">Error loading coupons. Please try again.</p>
                    </td>
                </tr>
            `;
        });
    });

    // Reset filter functionality
    resetFilter.addEventListener('click', function() {
        storeSelect.value = '';
        storeSelect.dispatchEvent(new Event('change'));
    });

    // Make table rows sortable (if using jQuery UI)
    $(function() {
        $("#tablecontents").sortable({
            items: "tr[data-id]",
            cursor: 'move',
            opacity: 0.6,
            handle: '.handle',
            update: function() {
                // You can add your save order logic here
            }
        });
    });

    // Save order button functionality
    document.getElementById('saveOrderBtn')?.addEventListener('click', function() {
        const rows = document.querySelectorAll('#tablecontents tr[data-id]');
        const order = Array.from(rows).map((row, index) => ({
            id: row.dataset.id,
            position: index + 1
        }));

        // Add your AJAX call to save the order
        console.log('Order to save:', order);
        // fetch('your-save-order-endpoint', { method: 'POST', body: JSON.stringify(order) })
        // .then(response => response.json())
        // .then(data => showToast('Order saved successfully!'));
    });
});
