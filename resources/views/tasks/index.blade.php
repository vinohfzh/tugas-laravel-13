@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')
    {{-- Stats --}}
    <div class="grid grid-cols-5 gap-3 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-sm">
            <p class="text-2xl font-bold">{{ $stats['total'] }}</p>
            <p class="text-xs text-gray-500">Total</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-sm">
            <p class="text-2xl font-bold text-yellow-500">{{ $stats['pending'] }}</p>
            <p class="text-xs text-gray-500">Pending</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-sm">
            <p class="text-2xl font-bold text-blue-500">{{ $stats['in_progress'] }}</p>
            <p class="text-xs text-gray-500">Dikerjakan</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-sm">
            <p class="text-2xl font-bold text-green-500">{{ $stats['done'] }}</p>
            <p class="text-xs text-gray-500">Selesai</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-sm">
            <p class="text-2xl font-bold text-red-500">{{ $stats['overdue'] }}</p>
            <p class="text-xs text-gray-500">Terlambat</p>
        </div>
    </div>

    <h1 class="text-xl font-bold mb-4">Daftar Tugas</h1>

    @if($tasks->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700 text-left text-xs uppercase text-gray-500 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Deadline</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($tasks as $task)
                        @php
                            $isOverdue = $task->deadline && $task->deadline->isPast() && $task->status !== 'done';
                        @endphp
                        <tr class="{{ $isOverdue ? 'bg-red-50 dark:bg-red-900/10' : '' }}">
                            <td class="px-4 py-3">
                                <a href="{{ route('tasks.show', $task) }}" class="font-medium text-indigo-600 dark:text-indigo-400 hover:underline">{{ $task->title }}</a>
                                @if($task->description)
                                    <p class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ $task->description }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($task->status === 'done')
                                    <span class="px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Selesai</span>
                                @elseif($task->status === 'in_progress')
                                    <span class="px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">Dikerjakan</span>
                                @else
                                    <span class="px-2 py-1 rounded text-xs font-medium bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">Pending</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm {{ $isOverdue ? 'text-red-600 font-medium' : 'text-gray-500' }}">
                                {{ $task->deadline ? $task->deadline->format('d M Y') : '-' }}
                                @if($isOverdue) <span class="text-xs">(terlambat)</span> @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-gray-400 hover:text-yellow-500" title="Edit">✏️</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500" title="Hapus">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-8 text-center">
            <p class="text-gray-400 mb-4">Belum ada tugas.</p>
            <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">+ Tambah Tugas</a>
        </div>
    @endif
@endsection
