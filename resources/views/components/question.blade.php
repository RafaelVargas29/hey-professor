@props([
    'question',
])

<div class="
        rounded dark:bg-gray-800/50 bg-white shadow shadow-pink-500/50
        p-3 dark:text-gray-400 flex justify-between items-center
    ">
    <!-- $question equivale ao $item no foreach do dashboard -->
    <!-- question é uma propriedade do objeto $question -->
    <span>{{ $question->question }}</span>

    <div>
        <!-- envia uma request para a rota question.like com o parâmetro $question, que é a questão referente -->
        <x-form :action="route('question.like', $question)">
            <button class="flex items-start space-x-1 text-green-500">
                <x-icons.thumbs-up class="w-5 h-5 hover:text-green-300 cursor-pointer"/>
                <span>{{ $question->votes_sum_like ?: 0 }}</span>
            </button>
        </x-form>

        <x-form :action="route('question.unlike', $question)">
            <button class="flex items-start space-x-1 text-red-500">
                <x-icons.thumbs-down class="w-5 h-5 hover:text-red-300 cursor-pointer"/>
                <span>{{ $question->votes_sum_unlike ?: 0 }}</span>
            </button>
        </x-form>


    </div>

</div>
