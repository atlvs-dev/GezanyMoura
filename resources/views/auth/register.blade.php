@php($title = 'Criar conta')

<x-guest-layout>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-md">
      <div class="text-center mb-6">
        <div class="mx-auto h-12 w-12 rounded-2xl bg-gray-900 text-white grid place-items-center text-lg font-semibold">A</div>
        <div class="mt-3 text-xl font-semibold tracking-tight text-gray-900">ATLVS</div>
        <div class="mt-1 text-sm text-gray-600">Crie sua conta para acessar o painel</div>
      </div>

      <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
          <div class="text-sm font-semibold text-gray-900">Cadastro</div>
          <div class="text-sm text-gray-600">Preencha os dados abaixo</div>
        </div>

        <div class="px-6 py-6">
          <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
              <x-input-label for="name" value="Nome" />
              <x-text-input id="name" class="mt-1 block w-full" type="text" name="name" required autofocus />
            </div>

            <div>
              <x-input-label for="email" value="Email" />
              <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" required />
            </div>

            <div>
              <x-input-label for="password" value="Senha" />
              <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required />
            </div>

            <div>
              <x-input-label for="password_confirmation" value="Confirmar senha" />
              <x-text-input id="password_confirmation" class="mt-1 block w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="pt-2 space-y-3">
              <button class="w-full h-10 rounded-xl bg-gray-900 text-white text-sm font-medium hover:bg-gray-800">
                Criar conta
              </button>

              <a href="{{ route('login') }}"
                 class="w-full h-10 rounded-xl border border-gray-300 text-sm font-medium hover:bg-gray-100 inline-flex items-center justify-center">
                Já tenho conta
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
