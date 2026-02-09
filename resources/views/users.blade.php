<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciamento de Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Lista de Usuários</h1>
                <a href="#" onclick="openCreateModal(event)" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">Criar Novo Usuário</a>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Data de Nascimento</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">CPF</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Saldo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $user->birthdate }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $user->cpf }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $user->saldo }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <a href="#" onclick="openViewModal(event, {{ $user->id }})" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                    <a href="#" onclick="openEditModal(event, {{ $user->id }})" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                    <a href="#" onclick="openDeleteModal(event, {{ $user->id }})" class="text-red-600 hover:text-red-900">Excluir</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Criar Usuário -->
    <div id="createModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Criar Novo Usuário</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="createForm" action="/users" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nome</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Senha</label>
                    <input type="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Data de Nascimento</label>
                    <input type="date" name="birthdate" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">CPF</label>
                    <input type="text" name="cpf" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Saldo</label>
                    <input type="number" name="saldo" step="0.01" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Ver Usuário -->
    <div id="viewModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Detalhes do Usuário</h3>
                <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nome</label>
                <input type="text" id="viewName" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 bg-gray-100 dark:bg-gray-600 cursor-not-allowed">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Email</label>
                <input type="email" id="viewEmail" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 bg-gray-100 dark:bg-gray-600 cursor-not-allowed">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Data de Nascimento</label>
                <input type="date" id="viewBirthdate" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 bg-gray-100 dark:bg-gray-600 cursor-not-allowed">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">CPF</label>
                <input type="text" id="viewCpf" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 bg-gray-100 dark:bg-gray-600 cursor-not-allowed">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Saldo</label>
                <input type="number" id="viewSaldo" step="0.01" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 bg-gray-100 dark:bg-gray-600 cursor-not-allowed">
            </div>
            <div class="flex justify-end gap-3 mt-4">
                <button type="button" onclick="closeViewModal()" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700">Fechar</button>
            </div>
        </div>
    </div>

    <!-- Modal Editar Usuário -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Editar Usuário</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="editForm" action="/users" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nome</label>
                    <input type="text" name="name" id="editName" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" id="editEmail" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Data de Nascimento</label>
                    <input type="date" name="birthdate" id="editBirthdate" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">CPF</label>
                    <input type="text" name="cpf" id="editCpf" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Saldo</label>
                    <input type="number" name="saldo" id="editSaldo" step="0.01" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Foto de Perfil</label>
                    <input type="file" name="profile_picture" id="editProfilePicture" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Atualizar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Excluir Usuário -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Excluir Usuário</h3>
                <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="text-gray-700 dark:text-gray-300 mb-4">Tem certeza que deseja excluir este usuário? Esta ação não poderá ser desfeita.</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-md hover:bg-gray-300 dark:hover:bg-gray-700">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Excluir</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal Criar
        function openCreateModal(e) {
            e.preventDefault();
            document.getElementById('createModal').classList.remove('hidden');
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
            document.getElementById('createForm').reset();
        }

        // Modal Ver
        function openViewModal(e, userId) {
            e.preventDefault();
            document.getElementById('viewModal').classList.remove('hidden');
            // Carregar dados do usuário via AJAX
            fetch(`/api/usuarios/${userId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('viewName').value = data.name;
                    document.getElementById('viewEmail').value = data.email;
                    document.getElementById('viewBirthdate').value = data.birthdate;
                    document.getElementById('viewCpf').value = data.cpf;
                    document.getElementById('viewSaldo').value = data.saldo;
                })
                .catch(error => console.error('Erro:', error));
        }

        function closeViewModal() {
            document.getElementById('viewModal').classList.add('hidden');
        }

        // Modal Editar
        function openEditModal(e, userId) {
            e.preventDefault();
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editForm').action = `/usuarios/${userId}`;
            // Carregar dados do usuário via AJAX
            fetch(`/api/usuarios/${userId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editName').value = data.name;
                    document.getElementById('editEmail').value = data.email;
                    document.getElementById('editBirthdate').value = data.birthdate;
                    document.getElementById('editCpf').value = data.cpf;
                    document.getElementById('editSaldo').value = data.saldo;
                    document.getElementById('editIsAdmin').checked = data.is_admin ? true : false;
                })
                .catch(error => console.error('Erro:', error));
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Modal Excluir
        function openDeleteModal(e, userId) {
            e.preventDefault();
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = `/usuarios/${userId}`;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Fechar modais ao clicar fora
        window.onclick = function(event) {
            const createModal = document.getElementById('createModal');
            const viewModal = document.getElementById('viewModal');
            const editModal = document.getElementById('editModal');
            const deleteModal = document.getElementById('deleteModal');

            if (event.target === createModal) closeCreateModal();
            if (event.target === viewModal) closeViewModal();
            if (event.target === editModal) closeEditModal();
            if (event.target === deleteModal) closeDeleteModal();
        }
    </script>

</x-app-layout>