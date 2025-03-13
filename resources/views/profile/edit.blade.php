@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Modifier mon profil</h1>
        
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-medium mb-2">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('profile.index') }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Annuler
                </a>
                <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-bold mb-6">Changer mon mot de passe</h2>

        <form action="{{route('profile.password.update')}}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="current_password" class="block text-gray-700 font-medium mb-2">Mot de passe actuel</label>
                <input type="password" name="current_password" id="current_password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Nouveau mot de passe </label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>


            <div class=" flex justify-end">
                <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                    Changer le mot de passe
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4 text-red-600">Supprimer mon compte</h2>
        
        <p class="mb-4 text-gray-600">Cette action est irréversible. Toutes vos données, y compris vos recettes, seront définitivement supprimées.</p>
        
        <div class="flex justify-end">
            <button onclick="openDeleteModal()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Supprimer mon compte
            </button>
        </div>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-8 max-w-md w-full shadow-xl">
        <h3 class="text-xl font-bold mb-4 text-red-600">Confirmation de suppression</h3>
        
        <p class="mb-4 text-gray-600">Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
        
        <form id="deleteForm" action="{{ route('profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            
            <div class="mb-4">
                <label for="confirm_password" class="block text-gray-700 font-medium mb-2">Entrez votre mot de passe pour confirmer</label>
                <input type="password" name="password" id="confirm_password" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                <p id="password-error" class="text-red-500 text-sm mt-1 hidden"></p>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeDeleteModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Annuler
                </button>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Supprimer définitivement
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('password-error').classList.add('hidden');
        document.getElementById('confirm_password').value = '';
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    function submitDeleteForm() {
        const form = document.getElementById('deleteForm');
        const password = document.getElementById('confirm_password').value;
        
        if (!password) {
            document.getElementById('password-error').textContent = 'Le mot de passe est requis.';
            document.getElementById('password-error').classList.remove('hidden');
            return;
        }
        
        // Utiliser fetch pour soumettre le formulaire via AJAX
        fetch(form.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                _method: 'DELETE',
                password: password
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                document.getElementById('password-error').textContent = data.message || 'Une erreur est survenue.';
                document.getElementById('password-error').classList.remove('hidden');
            }
        })
        .catch(error => {
            document.getElementById('password-error').textContent = 'Une erreur est survenue.';
            document.getElementById('password-error').classList.remove('hidden');
        });
    }
    
    // Fermer la modale si on clique en dehors
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            closeDeleteModal();
        }
    });
</script>
@endsection