<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REST API KODAM</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    @include('navbar')
    <div class="container p-3 mx-auto">
        <div class="bg-gray-200 dark:bg-gray-700 dark:text-white p-3 rounded mt-3">
            <p class="text-2xl font-semibold">Deskripsi API</p>
            <hr class="h-px my-2 bg-gray-400 border-0 dark:bg-gray-700">
            <p class="text-gray-600 dark:text-gray-400">Fitur API Kodam ini memungkinkan untuk mengelola data Kodam,
                termasuk menampilkan daftar Kodam dan menambahkan Kodam baru.</p>
            <br />
            <p class="text-2xl font-semibold">Endpoints API</p>
            <hr class="h-px my-2 bg-gray-400 border-0 dark:bg-gray-700">
            <div class="p-1">
                <ul class="max-w-md space-y-1 text-gray-600 list-disc list-inside dark:text-gray-400">
                    <li>GET /api/kodam: Mendapatkan daftar semua Kodam.</li>
                    <li>POST /api/kodam: Menambahkan Kodam baru.</li>
                </ul>
            </div>
            <br />
            <p class="text-2xl font-semibold">Deskripsi Endpoints</p>
            <hr class="h-px my-2 bg-gray-400 border-0 dark:bg-gray-700">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div class="dark:text-white p-3 rounded">
                    <p class="font-semibold">GET /api/kodam</p>
                    <p>Mengembalikan daftar semua Kodam yang ada.</p>
                    <p>Request:</p>
                    <ul class="max-w-md space-y-1 text-gray-600 list-disc list-inside dark:text-gray-400">
                        <li>Method: GET</li>
                        <li>Endpoint: /api/kodam</li>
                        <li>Header:
                            <ul class="max-w-md space-y-1 px-6 text-gray-600 list-disc list-inside dark:text-gray-400">
                                <li>Content-Type: application/json</li>
                            </ul>
                        </li>
                    </ul>
                    <div class="mt-3">
                        <p>Response Sukses:</p>
                        <ul class="max-w-md space-y-1 text-gray-600 list-disc list-inside dark:text-gray-400">
                            <li>Status Code: 200 (OK)</li>
                            <li>Body:</li>
                        </ul>
                        <div
                            class="relaive overflow-x-auto bg-gray-400 dark:bg-gray-700 dark:text-white p-3 rounded mt-3">
                            <pre><code>[
    {
        "id": 2,
        "nama": "Sendal Jepit",
        "created_at": "2024-06-21T07:30:11.000000Z",
        "updated_at": "2024-06-21T07:30:11.000000Z"
    },
    {
        "id": 3,
        "nama": "Semvak Firaun",
        "created_at": "2024-06-21T07:30:11.000000Z",
        "updated_at": "2024-06-21T07:30:11.000000Z"
    },
]</code></pre>
                        </div>
                    </div>
                </div>
                <div class="dark:text-white p-3 rounded">
                    <p class="font-semibold">POST /api/kodam</p>
                    <p>Menambahkan Kodam baru.</p>
                    <ul class="max-w-md space-y-1 text-gray-600 list-disc list-inside dark:text-gray-400">
                        <li>Method: GET</li>
                        <li>Endpoint: /api/kodam</li>
                        <li>Header:
                            <ul class="max-w-md space-y-1 px-6 text-gray-600 list-disc list-inside dark:text-gray-400">
                                <li>Content-Type: application/json</li>
                            </ul>
                        </li>
                        <li>
                            Body:
                            <div
                                class="relative overflow-x-auto bg-gray-400 dark:bg-gray-700 text-gray-800 dark:text-white p-3 rounded mt-3">
                                <pre><code>[
    {
        "nama": "Ular berkepala Singa",
    }
]</code></pre>
                            </div>
                        </li>
                    </ul>
                    <div class="mt-3">
                        <p>Response Sukses:</p>
                        <ul class="max-w-md space-y-1 px-6 text-gray-600 list-disc list-inside dark:text-gray-400">
                            <li>Status Code: 201 (Created)</li>
                            <li>Body:</li>
                        </ul>
                        <div class="mt-3">
                            <pre class="relative overflow-x-auto bg-gray-400 dark:bg-gray-700 text-gray-800 dark:text-white p-3 rounded mt-3"><code>{
    "id": 2,
    "nama": "Sendal Jepit",
    "created_at": "2024-06-21T07:30:11.000000Z",
    "updated_at": "2024-06-21T07:30:11.000000Z"
},</code></pre>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <p class="text-2xl font-semibold">Contoh Penggunaan</p>
            <hr class="h-px my-2 bg-gray-400 border-0 dark:bg-gray-700">
            <p>Mengambil Daftar Kodam</p>
            <div class="grid grid-cols-1 mdLgrid-cols-2 gap-2">
                <p>Request:</p>
                <div
                    class="relative overflow-x-auto bg-gray-400 dark:bg-gray-700 text-gray-800 dark:text-white p-3 rounded mt-1">
                    <pre><code>curl -X GET http://127.0.0.1:8000/api/kodam</code></pre>
                </div>
                <p>Response:</p>
                <div
                    class="relative overflow-x-auto bg-gray-400 dark:bg-gray-700 text-gray-800 dark:text-white p-3 rounded mt-1">
                    <pre><code>{
    "id": 2,
    "nama": "Sendal Jepit",
    "created_at": "2024-06-21T07:30:11.000000Z",
    "updated_at": "2024-06-21T07:30:11.000000Z"
},
{
    "id": 3,
    "nama": "Semvak Firaun",
    "created_at": "2024-06-21T07:30:11.000000Z",
    "updated_at": "2024-06-21T07:30:11.000000Z"
},
</code></pre>
                </div>
                <p>Menambahkan Kodam Baru</p>
                <p>Request:</p>
                <div
                    class="relative overflow-x-auto bg-gray-400 dark:bg-gray-700 text-gray-800 dark:text-white p-3 rounded mt-1">
                    <pre><code>curl -X POST \
http://127.0.0.1:8000/api/kodam \
-H 'Content-Type: application/json' \
-d '{
        "nama": "Semvak Firaun",
    }'</code></pre>
                </div>
                <p>Response:</p>
                <div
                    class="relative overflow-x-auto bg-gray-400 dark:bg-gray-700 text-gray-800 dark:text-white p-3 rounded mt-1">
                    <pre><code>{
    "id": 5,
    "nama": "Prabu Siliwangi",
    "created_at": "2024-06-21T07:30:11.000000Z",
    "updated_at": "2024-06-21T07:30:11.000000Z"
},</code></pre>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
