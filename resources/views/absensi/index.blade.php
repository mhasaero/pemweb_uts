@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">📊 Data Absensi Mahasiswa</h1>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Mahasiswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($absensi as $absen)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ $absen->mahasiswa->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ $absen->matkul->nama_mk }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ date('d M Y', strtotime($absen->tanggal)) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form 
                                    action="{{ route('absensi.update', [
                                        'nim' => $absen->nim,
                                        'id_mk' => $absen->id_mk,
                                        'tanggal' => $absen->tanggal
                                    ]) }}" 
                                    method="POST"
                                    class="flex items-center gap-2"
                                >
                                    @csrf
                                    @method('PUT')
                                    
                                    <select 
                                        name="status_kehadiran"
                                        class="px-3 py-1 rounded border 
                                            @if($absen->status_kehadiran == 1) border-green-200 bg-green-50
                                            @else border-red-200 bg-red-50
                                            @endif
                                            hover:shadow-sm transition-all cursor-pointer"
                                    >
                                        <option value="1" {{ $absen->status_kehadiran === 1 ? 'selected' : '' }}>Hadir</option>
                                        <option value="0" {{ $absen->status_kehadiran === 0 ? 'selected' : '' }}>Alfa</option>
                                    </select>
                                    @if (Auth::user()->type == 1)
                                    <button 
                                        type="submit" 
                                        class="px-2 py-1 rounded-md flex items-center gap-1
                                            @if($absen->status_kehadiran === 1) bg-green-500 hover:bg-green-600
                                            @else bg-red-500 hover:bg-red-600
                                            @endif 
                                            text-white transition-colors"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293z"/>
                                        </svg>
                                        Update
                                    </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($absensi->isEmpty())
                <div class="text-center py-6 text-gray-500">
                    📭 Tidak ada data absensi yang tersedia
                </div>
            @endif
        </div>
    </div>
    @endsection