<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Code Challenge - Mira</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite('resources/css/app.css')
    
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100">
            <div class="max-w-7xl mx-auto p-6 sm:w-full space-y-4">
                <!-- Uploaded Document Excel -->
                <div class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div class="w-full">
                        <h2 class="mt-2 text-xl font-semibold text-gray-900">Upload from file</h2>

                        <p class="mt-2 text-gray-500 text-sm leading-relaxed">
                            <a href="{{ route('download.excel.template') }}" class="underline hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Download Excel Template</a>
                        </p>


                        <form id="uploadForm" method="POST" action="{{ route('students.upload') }}" enctype="multipart/form-data" class="w-full">
                            @csrf

                            @if (session('success'))
                                <div class="rounded-md bg-blue-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                        </svg>
                                        </div>
                                        <div class="ml-3 flex-1 md:flex md:justify-between">
                                            <p class="text-sm text-blue-700">{{ session('success') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="rounded-md bg-red-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                        </svg>
                                        </div>
                                        <div class="ml-3 flex-1 md:flex md:justify-between">
                                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="rounded-md bg-red-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3 flex-1 md:flex md:justify-between">
                                            @foreach ($errors->all() as $error)
                                                <p class="text-sm text-red-700">{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="mt-2">
                                <div class="relative">
                                    <input type="file" name="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="chooseFile" onchange="updateFileName(this)">
                                    <label for="chooseFile" class="block py-2 px-4 border rounded-lg text-gray-700 cursor-pointer" id="chooseFileLabel">
                                        Choose file
                                    </label>
                                    <span class="absolute inset-y-0 right-0 flex items-center">
                                        <label for="chooseFile" class="px-4 py-2 bg-gray-500 text-white cursor-pointer hover:bg-gray-600 focus:bg-gray-600 rounded-br-lg rounded-tr-lg">
                                            Browse
                                        </label>
                                    </span>
                                </div>
                            </div>

                            <div class="flex justify-center space-x-2 py-4 w-full">
                                <button type="submit" class="flex items-center justify-center w-full py-2 px-4 border rounded-lg shadow-sm text-sm font-medium text-indigo-600 border-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 uppercase">
                                    Upload
                                </button>

                                <button type="button" class="flex items-center justify-center w-full py-2 px-4 border rounded-lg shadow-sm text-sm font-medium text-red-600 border-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 uppercase" onclick="resetForm()">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Display Data -->
                <div class="p-6 bg-white rounded-lg shadow-2xl">
                    <div class="overflow-x-auto border-t">
                        <table class="w-full text-left">
                            <thead class="bg-white">
                            <tr>
                                <th scope="col" class="relative isolate py-3.5 pr-3 text-left text-sm font-semibold text-gray-900">
                                Name
                                <div class="absolute inset-y-0 right-full -z-10 w-screen border-b border-b-gray-200"></div>
                                <div class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-b-gray-200"></div>
                                </th>
                                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">Level</th>
                                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 md:table-cell">Class</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Parents Contact</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                    <tr>
                                        <td class="py-4 pr-3 text-sm font-medium text-gray-500">
                                            {{ $student->name }}
                                        </td>
                                        <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ $student->level }}</td>
                                        <td class="hidden px-3 py-4 text-sm text-gray-500 md:table-cell">{{ $student->class }}</td>
                                        <td class="px-3 py-4 text-sm text-gray-500">{{ $student->parent_contact }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-4 text-center text-sm text-gray-900 font-semibold" colspan="4">
                                            No data
                                        </td>
                                    </tr>
                                    
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function updateFileName(input) {
                const fileLabel = document.getElementById('chooseFileLabel');
                if (input.files.length > 0) {
                    fileLabel.textContent = input.files[0].name;
                } else {
                    fileLabel.textContent = 'Choose file';
                }
            }

            function resetForm() {
                document.getElementById("uploadForm").reset();
            }
        </script>
    </body>
</html>
