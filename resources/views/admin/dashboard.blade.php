@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard Administrateur</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-indigo-600">Utilisateurs</h2>
                <p class="text-3xl font-bold">{{ $stats['users_count'] }}</p>
                <a href="{{route ('admin.users.index')}}" class="text-sm text-indigo-600 hover:underline">Gérer les utilisateurs</a>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-indigo-600">Recettes</h2>
                <p class="text-3xl font-bold">{{ $stats['recettes_count'] }}</p>
                <a href="" class="text-sm text-indigo-600 hover:underline"></a>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-indigo-600">Catégories</h2>
                <p class="text-3xl font-bold">{{ $stats['categories_count'] }}</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">Derniers utilisateurs inscrits</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-sm font-medium text-gray-500 border-b">
                                <th class="pb-2">Nom</th>
                                <th class="pb-2">Email</th>
                                <th class="pb-2">Date d'inscription</th>
                                <th class="pb-2">Compte Verifié</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_users as $user)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-2">{{ $user->name }}</td>
                                    <td class="py-2">{{ $user->email }}</td>
                                    <td class="py-2">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="py-2">{{$user->email_verified ? 'Oui' : 'Non'}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">Dernières recettes ajoutées</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-sm font-medium text-gray-500 border-b">
                                <th class="pb-2">Titre</th>
                                <th class="pb-2">Catégorie</th>
                                <th class="pb-2">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_recettes as $recette)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-2">{{ $recette->titre }}</td>
                                    <td class="py-2">{{ $recette->categorie->nom ?? 'Non catégorisé' }}</td>
                                    <td class="py-2">{{ $recette->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection