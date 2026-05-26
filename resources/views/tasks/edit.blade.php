@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('content')
<div class="max-w-xl mx-auto">
    <a href="{{ route('tasks.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 mb-4 inline-block">← Kembali</a>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <h1 class="text-xl font-bold mb-6">Edit Tugas</h1>

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium mb-1">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('description', $task->description) }}</textarea>
                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="status" class="block text-sm font-medium mb-1">Status</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>Dikerjakan</option>
                        <option value="done" {{ old('status', $task->status) === 'done' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div>
                    <label for="deadline" class="block text-sm font-medium mb-1">Deadline</label>
                    <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $task->deadline?->format('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-5 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition">Perbarui</button>
                <a href="{{ route('tasks.index') }}" class="px-5 py-2 text-gray-500 hover:text-gray-700">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
