@extends('layouts.app')

@section('title', 'Gestion des utilisateurs')

@section('content')
    <div class="mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Gestion des utilisateurs</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:underline">← Retour au dashboard</a>
        </div>
        
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-left">
                        <th class="px-4 py-3 text-sm font-medium text-gray-500">ID</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500">Nom</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500">Email</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500">Rôle</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500">Date d'inscription</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $user->id }}</td>
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                @if($user->isAdmin())
                                    <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs">Admin</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">Utilisateur</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex space-x-2">
                                    <form method="POST" action="{{ route('admin.users.toggle-admin', $user) }}" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-800" title="{{ $user->isAdmin() ? 'Retirer les droits admin' : 'Donner les droits admin' }}">
                                            <i class="fas fa-{{ $user->isAdmin() ? 'user-minus' : 'user-plus' }}"></i>
                                        </button>
                                    </form>
                                    
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="px-4 py-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection 