<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciamento de Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($errors->any())
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="bg-[#2f1c37] border-l-4 border-[#e8675c] p-4 rounded shadow-lg">
                    <strong class="text-[#e8675c] font-bold text-lg">Opa! Algo deu errado:</strong>
                    <ul class="mt-2 list-disc list-inside text-white text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Lista de Usuários</h1>
                <a href="#" onclick="openCreateModal(event)" class="px-4 py-2 bg-[#c91b7a] text-white rounded-md font-bold hover:opacity-90 transition">Criar Novo Usuário</a>
            </div>
            <div class="bg-[#2f1c37] overflow-hidden shadow-sm sm:rounded-lg border border-[#482b52]">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full border-none">
                        <thead class="bg-[#482b52]">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Data de Nascimento</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">CPF</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Saldo</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-[#2f1c37] divide-y divide-[#482b52]">
                            @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-white">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-white">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-white">{{ $user->birthdate }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-white">{{ $user->cpf }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-white">{{ $user->saldo }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center">
                                    <a href="#" onclick="openViewModal(event, {{ $user->id }})" class="text-[#ffca06] hover:opacity-80 mr-3 font-bold">Ver</a>
                                    <a href="#" onclick="openEditModal(event, {{ $user->id }})" class="text-[#c91b7a] hover:opacity-80 mr-3 font-bold">Editar</a>
                                    <a href="#" onclick="openDeleteModal(event, {{ $user->id }})" class="text-[#e8675c] hover:opacity-80 font-bold">Excluir</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 px-4 py-3 border-t border-[#482b52] flex items-center justify-between">
                        <div class="text-sm text-white font-medium">
                            Mostrando <span class="font-bold text-white">{{ $users->firstItem() }}</span> 
                            até <span class="font-bold text-white">{{ $users->lastItem() }}</span> 
                            de <span class="font-bold text-white">{{ $users->total() }}</span> resultados
                        </div>

                        <div class="pagination-codevolt">
                            {{ $users->links() }}
                        </div>
                    </div>
                    <style>
                        .pagination-codevolt nav span[aria-current="page"] span {
                            background-color: #e8675c; 
                            border-color: #e8675c;
                            color: white;
                            font-weight: bold;
                        }

                        .pagination-codevolt nav a, 
                        .pagination-codevolt nav span {
                            background-color: #2f1c37;
                            color: white;
                            border-color: #482b52;
                        }

                        .pagination-codevolt nav a:hover {
                            background-color: #482b52;
                            color: #ffca06;
                        }

                        .pagination-codevolt nav div:first-child p {
                            display: none;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>

    <div id="createModal" class="hidden fixed inset-0 bg-[#1a0b1e]/60 backdrop-blur-md overflow-y-auto h-full w-full z-50 transition-all duration-300">
        <div class="relative top-20 mx-auto p-5 border border-[#482b52] w-96 shadow-2xl rounded-md bg-[#2f1c37]">
            <div class="flex justify-between items-center mb-4 border-b border-[#482b52] pb-2">
                <h3 class="text-lg font-bold text-white">Criar Novo Usuário</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="createForm" action="/users" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Nome</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Senha</label>
                    <input type="password" name="password" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Data de Nascimento</label>
                    <input type="date" name="birthdate" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">CPF</label>
                    <input type="text" name="cpf" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Saldo</label>
                    <input type="number" name="saldo" step="0.01" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 text-white bg-[#482b52] rounded-md hover:bg-[#5a3666] transition">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-[#c91b7a] text-white font-bold rounded-md hover:bg-[#a11562] transition shadow-lg">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <div id="viewModal" class="hidden fixed inset-0 bg-[#1a0b1e]/60 backdrop-blur-md overflow-y-auto h-full w-full z-50 transition-all duration-300">
        <div class="relative top-20 mx-auto p-5 border border-[#482b52] w-96 shadow-2xl rounded-md bg-[#2f1c37]">
            <div class="flex justify-between items-center mb-4 border-b border-[#482b52] pb-2">
                <h3 class="text-lg font-bold text-white">Detalhes do Usuário</h3>
                <button onclick="closeViewModal()" class="text-gray-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Nome</label>
                    <input type="text" id="viewName" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300 cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Email</label>
                    <input type="email" id="viewEmail" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300 cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Data de Nascimento</label>
                    <input type="date" id="viewBirthdate" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300 cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-1 uppercase">CPF</label>
                    <input type="text" id="viewCpf" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300 cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-bold mb-1 uppercase">Saldo</label>
                    <input type="number" id="viewSaldo" step="0.01" readonly class="w-full px-3 py-2 bg-[#1a0b1e]/50 border border-[#482b52] rounded-md text-gray-300 cursor-not-allowed font-mono text-yellow-400">
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="button" onclick="closeViewModal()" class="px-6 py-2 text-white bg-[#482b52] rounded-md hover:bg-[#5a3666] transition font-bold">Fechar</button>
            </div>
        </div>
    </div>

    <div id="editModal" class="hidden fixed inset-0 bg-[#1a0b1e]/60 backdrop-blur-md overflow-y-auto h-full w-full z-50 transition-all duration-300">
        <div class="relative top-20 mx-auto p-5 border border-[#482b52] w-96 shadow-2xl rounded-md bg-[#2f1c37]">
            <div class="flex justify-between items-center mb-4 border-b border-[#482b52] pb-2">
                <h3 class="text-lg font-bold text-white">Editar Usuário</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="editForm" action="/users" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Nome</label>
                    <input type="text" name="name" id="editName" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" id="editEmail" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Data de Nascimento</label>
                    <input type="date" name="birthdate" id="editBirthdate" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">CPF</label>
                    <input type="text" name="cpf" id="editCpf" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Saldo</label>
                    <input type="number" name="saldo" id="editSaldo" step="0.01" required class="w-full px-3 py-2 bg-[#1a0b1e] border border-[#482b52] rounded-md focus:outline-none focus:border-[#c91b7a] text-white font-mono text-yellow-400">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Foto de Perfil</label>
                    <input type="file" name="profile_picture" id="editProfilePicture" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#482b52] file:text-white hover:file:bg-[#5a3666] cursor-pointer">
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-white bg-[#482b52] rounded-md hover:bg-[#5a3666] transition">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-[#c91b7a] text-white font-bold rounded-md hover:bg-[#a11562] transition shadow-lg">Atualizar</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="hidden fixed inset-0 bg-[#1a0b1e]/60 backdrop-blur-md overflow-y-auto h-full w-full z-50 transition-all duration-300">
        <div class="relative top-20 mx-auto p-5 border border-[#e8675c]/30 w-96 shadow-2xl rounded-md bg-[#2f1c37]">
            <div class="flex justify-between items-center mb-4 border-b border-[#482b52] pb-2">
                <h3 class="text-lg font-bold text-[#e8675c]">Excluir Usuário</h3>
                <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="text-gray-300 mb-6 text-center">
                Tem certeza que deseja excluir este usuário? <br>
                <span class="text-[#e8675c] font-bold text-sm uppercase mt-2 block">Esta ação não poderá ser desfeita.</span>
            </p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-center gap-4">
                    <button type="button" onclick="closeDeleteModal()" class="px-6 py-2 text-white bg-[#482b52] rounded-md hover:bg-[#5a3666] transition font-bold">
                        Cancelar
                    </button>
                    <button type="submit" class="px-6 py-2 bg-[#e8675c] text-white font-bold rounded-md hover:bg-[#c54f45] transition shadow-lg">
                        Confirmar Exclusão
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const usersData = {};
        @foreach($users as $user)
            usersData[{{ $user->id }}] = {!! json_encode([
                'name' => $user->name,
                'email' => $user->email,
                'birthdate' => $user->birthdate,
                'cpf' => $user->cpf,
                'saldo' => $user->saldo,
                'profile_picture' => $user->profile_picture ?? null,
            ]) !!};
        @endforeach

        function openCreateModal(e) {
            e.preventDefault();
            document.getElementById('createModal').classList.remove('hidden');
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
            document.getElementById('createForm').reset();
        }

        function openViewModal(e, userId) {
            e.preventDefault();
            const data = usersData[userId];
            if (!data) return;
            document.getElementById('viewName').value = data.name;
            document.getElementById('viewEmail').value = data.email;
            document.getElementById('viewBirthdate').value = data.birthdate;
            document.getElementById('viewCpf').value = data.cpf;
            document.getElementById('viewSaldo').value = data.saldo;
            document.getElementById('viewModal').classList.remove('hidden');
        }

        function closeViewModal() {
            document.getElementById('viewModal').classList.add('hidden');
        }

        function openEditModal(e, userId) {
            e.preventDefault();
            const data = usersData[userId];
            if (!data) return;
            document.getElementById('editForm').action = `/users/${userId}`;
            document.getElementById('editName').value = data.name;
            document.getElementById('editEmail').value = data.email;
            document.getElementById('editBirthdate').value = data.birthdate;
            document.getElementById('editCpf').value = data.cpf;
            document.getElementById('editSaldo').value = data.saldo;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function openDeleteModal(e, userId) {
            e.preventDefault();
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = `/users/${userId}`;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        window.onclick = function(event) {
            if (event.target === document.getElementById('createModal')) closeCreateModal();
            if (event.target === document.getElementById('viewModal')) closeViewModal();
            if (event.target === document.getElementById('editModal')) closeEditModal();
            if (event.target === document.getElementById('deleteModal')) closeDeleteModal();
        }
    </script>
</x-app-layout>