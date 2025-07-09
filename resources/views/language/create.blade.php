<!DOCTYPE html>
<html>
<head>
    <title>Create Language</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 15px; background: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background: #45a049; }
        #error-message { color: red; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Create New Language</h1>
    <form id="createLanguageForm">
        <div id="error-message"></div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="code">Code:</label>
            <input type="text" id="code" name="code" required>
        </div>
        <div class="form-group">
            <label for="flag">Flag (optional):</label>
            <input type="file" id="flag" name="flag">
        </div>
        <div class="form-group">
            <label for="direction">Direction:</label>
            <select id="direction" name="direction">
                <option value="ltr" selected>Left to Right (LTR)</option>
                <option value="rtl">Right to Left (RTL)</option>
            </select>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" id="status" name="status"  checked> Active
            </label>
        </div>
        <button type="submit">Create Language</button>
    </form>


    <script>
        document.getElementById('createLanguageForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const errorElement = document.getElementById('error-message');
            errorElement.textContent = '';

            const form = document.getElementById('createLanguageForm');
            const formData = new FormData(form);

            // Handle checkbox manually (not all browsers include unchecked checkboxes)
            formData.set('status', document.getElementById('status').checked ? 1 : 0);

            fetch('/api/language', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    // Do NOT set Content-Type when using FormData!
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) throw response;
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Language created successfully!');
                    window.location.href = '/language';
                } else {
                    const errorMsg = data.errors ? Object.values(data.errors).join('\n') : 'Unknown error';
                    errorElement.textContent = errorMsg;
                }
            })
            .catch(async (error) => {
                const err = await error.json().catch(() => null);
                console.error('Error:', err || error);
                const message = err?.errors ? Object.values(err.errors).join('\n') : 'Failed to create language.';
                errorElement.textContent = message;
            });
        });
    </script>

</body>
</html>
