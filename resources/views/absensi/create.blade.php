{{-- resources/views/absensi/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-2xl font-bold mb-4">Form Input Absensi</h2>
            
            <form action="{{ route('absensi.store') }}" method="POST">
                @csrf
                
                <!-- Pilih Mata Kuliah -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="id_mk">
                        Mata Kuliah
                    </label>
                    <select name="id_mk" id="id_mk" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                        <option value="">Pilih Mata Kuliah</option>
                        @foreach($matakuliah as $mk)
                            <option value="{{ $mk->id_mk }}">{{ $mk->nama_mk }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Input Tanggal -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal">
                        Tanggal
                    </label>
                    <input type="date" name="tanggal" id="tanggal"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                        required>
                </div>

                <!-- Daftar Mahasiswa -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Daftar Mahasiswa</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">NIM</th>
                                    <th class="px-4 py-2">Nama</th>
                                    <th class="px-4 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahasiswa as $mhs)
                                <tr>
                                    <td class="border px-4 py-2">{{ $mhs->nim }}</td>
                                    <td class="border px-4 py-2">{{ $mhs->nama }}</td>
                                    <td class="border px-4 py-2">
                                        <select name="status[{{ $mhs->nim }}]" 
                                            class="w-full border rounded px-2 py-1">
                                            <option value="1">Hadir</option>
                                            <option value="0">Alfa</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Absensi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection