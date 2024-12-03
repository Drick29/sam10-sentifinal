<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sentiment Analysis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Header Section -->
                    <div class="flex flex-wrap justify-between items-center mb-6">
                        <h3 class="text-xl font-bold mb-2 sm:mb-0">Analyze Text Sentiment</h3>
                        <a href="{{ route('sentiment.history') }}" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition duration-300">
                            View Sentiment History
                        </a>
                    </div>

                    <!-- Sentiment Result -->
                    @if(session('result'))
                        <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded">
                            <p><strong>Sentiment:</strong> {{ session('result')['sentiment'] }}</p>
                            <p><strong>Positive Score:</strong> {{ session('result')['positiveScore'] }}%</p>
                            <p><strong>Negative Score:</strong> {{ session('result')['negativeScore'] }}%</p>
                            <p><strong>Neutral Score:</strong> {{ session('result')['neutralScore'] }}%</p>
                            <p><strong>Compound Score:</strong> {{ session('result')['compoundScore'] }}%</p>
                        </div>

                        <!-- Chart Section -->
                        <div class="relative w-full mb-6 flex justify-center">
                            <canvas id="sentimentChart" style="max-width: 300px; max-height: 300px;"></canvas>
                        </div>
                        <script>
                            const ctx = document.getElementById('sentimentChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ['Positive', 'Negative', 'Neutral'],
                                    datasets: [{
                                        data: [
                                            {{ session('result')['positiveScore'] }},
                                            {{ session('result')['negativeScore'] }},
                                            {{ session('result')['neutralScore'] }}
                                        ],
                                        backgroundColor: ['#4CAF50', '#F44336', '#FFC107'],
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                    },
                                },
                            });
                        </script>
                    @endif

                    <!-- Input Form -->
                    <form action="{{ route('sentiment.analyze') }}" method="POST">
                        @csrf
                        <label for="text" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Enter text to analyze:</label>
                        <textarea name="text" id="text" rows="4" 
                            class="w-full p-3 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
                            placeholder="Type here..."></textarea>
                        <button type="submit" 
                            class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-300">
                            Analyze Sentiment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
