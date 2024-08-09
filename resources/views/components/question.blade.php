@props([
    'question',
])

<div class="rounded dark:bg-gray-800/50 bg-white shadow shadow-pink-500/50 p-3 dark:text-gray-400">
    <!-- $question equivale ao $item no foreach do dashboard -->
    <!-- question é uma propriedade do objeto $question -->
    {{ $question->question }}
</div>
