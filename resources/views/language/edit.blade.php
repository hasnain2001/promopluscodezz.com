<!DOCTYPE html>
<html>
<head>
    <title>Edit Language</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 15px; background: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background: #45a049; }
        #error-message { color: red; margin-top: 10px; }
        img { margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Edit Language</h1>
    <form id="editLanguageForm" enctype="multipart/form-data">
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
            <img id="currentFlag" src="" alt="" width="50" />
        </div>
        <div class="form-group">
            <label for="direction">Direction:</label>
            <select id="direction" name="direction">
                <option value="ltr">Left to Right (LTR)</option>
                <option value="rtl">Right to Left (RTL)</option>
            </select>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" id="status" name="status"> Active
            </label>
        </div>
        <button type="submit">Update Language</button>
    </form>
    <div id="error-message"></div>

    <script>
        const languageId = {{ $id }};
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Fetch existing data
        fetch(`/api/language/${languageId}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const lang = data.data;
                    document.getElementById('name').value = lang.name;
                    document.getElementById('code').value = lang.code;
                    document.getElementById('direction').value = lang.direction;
                    document.getElementById('status').checked = !!lang.status;
                    if (lang.flag) {
                        document.getElementById('currentFlag').src = '/storage/' + lang.flag;
                    }
                }
            });

        // Handle form submission
        document.getElementById('editLanguageForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = document.getElementById('editLanguageForm');
            const formData = new FormData(form);
            formData.set('_method', 'PUT');
            formData.set('status', document.getElementById('status').checked ? 1 : 0);

            fetch(`/api/language/${languageId}`, {
                method: 'POST', // Laravel requires POST with `_method` override for PUT
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Language updated successfully!');
                    window.location.href = '/language';
                } else {
                    document.getElementById('error-message').textContent =
                        Object.values(data.errors || {}).flat().join('\n') || 'Update failed';
                }
            })
            .catch(async (error) => {
                const errData = await error.json().catch(() => null);
                const msg = errData?.errors
                    ? Object.values(errData.errors).flat().join('\n')
                    : 'Update failed';
                document.getElementById('error-message').textContent = msg;
            });
        });
    </script>
</body>
</html>
