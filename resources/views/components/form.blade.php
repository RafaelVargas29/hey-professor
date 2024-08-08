<!-- Propriedades que serão aceitas no componente (se estiver sem null ou valor padrão é uma propriedade obrigatória)-->
@props([
    'action',
    'post' => null,
    'put' => null,
    'delete' => null
])

<form action="{{ route('question.store')}}" class="max-w-sm mx-auto" method="POST">
    <!-- Diretiva que adiciona um toke de validação ao meu formulário-->
    @csrf

    <!-- Verifica se o método put foi adicionado e troca o método para PUT-->
    @if ($put)
        @method('PUT')
    @endif

    <!-- Verifica se o método delete foi adicionado e troca o método para DELETE-->
    @if ($delete)
        @method('DELETE')
    @endif

    <!-- Indica que é o local onde vai receber conteúdo -->
    {{ $slot }}

</form>
