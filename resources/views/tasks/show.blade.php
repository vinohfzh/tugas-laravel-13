@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="max-w-xl mx-auto">
    <a href="{{ route('tasks.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 mb-4 inline-block">← Kembali</a>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <div class="flex items-start justify-between mb-4">
            <h1 class="text-xl font-bold">{{ $task->title }}</h1>
            @if($task->status === 'done')
                <span class="px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Selesai</span>
            @elseif($task->status === 'in_progress')
                <span class="px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">Dikerjakan</span>
            @else
                <span class="px-2 py-1 rounded text-xs font-medium bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">Pending</span>
            @endif
        </div>

        <div class="mb-6">
            <h2 class="text-xs font-semibold text-gray-400 uppercase mb-1">Deskripsi</h2>
            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $task->description ?: 'Tidak ada deskripsi' }}</p>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-6 text-sm">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase mb-1">Deadline</p>
                @php $isOverdue = $task->deadline && $task->deadline->isPast() && $task->status !== 'done'; @endphp
                <p class="{{ $isOverdue ? 'text-red-600 font-medium' : '' }}">
                    {{ $task->deadline ? $task->deadline->format('d M Y') : '-' }}
                    @if($isOverdue) <span class="text-xs">(terlambat)</span> @endif
                </p>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase mb-1">Dibuat</p>
                <p>{{ $task->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase mb-1">Diperbarui</p>
                <p>{{ $task->updated_at->diffForHumans() }}</p>
            </div>
        </div>

        <div class="flex gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
            <a href="{{ route('tasks.edit', $task) }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Edit</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 border border-red-300 text-red-600 text-sm font-medium rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
