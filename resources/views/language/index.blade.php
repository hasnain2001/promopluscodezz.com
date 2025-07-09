<!DOCTYPE html>
<html>
<head>
    <title>Languages List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f2f2f2; }
        button { padding: 5px 10px; margin-right: 5px; cursor: pointer; }
        .edit-btn { background-color: #2196F3; color: white; border: none; }
        .delete-btn { background-color: #f44336; color: white; border: none; }
    </style>
</head>
<body>
    <h1>Languages List</h1>
    <a href="{{ route('langauge.create') }}">add new</a>
    <table id="languagesTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Code</th>
                <th>Flag</th>
                <th>Direction</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        function loadLanguages() {
            fetch('/api/language')
                .then(response => {
                    if (!response.ok) throw new Error('Failed to fetch languages.');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const tbody = document.querySelector('#languagesTable tbody');
                        tbody.innerHTML = ''; // Clear table first
                        data.data.forEach(language => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${language.id}</td>
                                <td>${language.name}</td>
                                <td>${language.code}</td>
                                <td>${language.flag ? `<img src="/storage/${language.flag}" width="40">` : '—'}</td>
                                <td>${language.direction}</td>
                                <td>${language.status ? 'Active' : 'Inactive'}</td>
                                <td>
                                    <button class="edit-btn" onclick="editLanguage(${language.id})">Edit</button>
                                    <button class="delete-btn" onclick="deleteLanguage(${language.id})">Delete</button>
                                </td>
                            `;
                            tbody.appendChild(row);
                        });
                    } else {
                        alert('Failed to load languages');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Error loading languages');
                });
        }

        function deleteLanguage(id) {
            if (!confirm('Are you sure you want to delete this language?')) return;

            fetch(`/api/language/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Delete failed.');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Language deleted successfully');
                    loadLanguages();
                } else {
                    alert('Failed to delete language');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Error deleting language');
            });
        }

        function editLanguage(id) {
            // Redirect to edit page (you must create this route/view)
            window.location.href = `/language/edit/${id}`;
        }

        // Load on page load
        loadLanguages();
    </script>
</body>
</html>
