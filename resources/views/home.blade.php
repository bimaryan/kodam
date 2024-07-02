<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cek Kodam Online</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>
        .blur-card {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            width: 100%;
            max-width: 400px;
        }

        .form-container {
            margin: auto;
        }

        .full-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>

<body class="bg-gray-300">
    <div class="full-screen">
        <div class="blur-card dark:bg-gray-700 dark:text-white p-3 rounded shadow">
            <h1 class="text-center mb-2">Cek Kodam</h1>
            <form method="POST" action="{{ url('/') }}" class="form-container mt-3">
                @csrf
                <div class="mb-3">
                    <input type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Tulis nama kamu disini" id="nama" name="nama">
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Generate
                    Kodam</button>
            </form>
        </div>

        @if (isset($kodam))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const modal = new Modal(document.getElementById('kodamModal'));
                    modal.show();
                });
            </script>

            <div id="kodamModal" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                <div class="relative w-full h-full max-w-md md:h-auto">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="p-6 text-center">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Hasil Kodam</h2>
                            <p class="mt-4"><strong>Nama:</strong> {{ $nama }}</p>
                            <p><strong>Kodam:</strong> {{ $kodam->nama }}</p>
                            <button data-modal-hide="kodamModal" type="button"
                                class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
