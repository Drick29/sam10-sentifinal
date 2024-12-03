<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-lg">
                <div class="p-6 text-gray-800 dark:text-gray-200">
                    <!-- Action Buttons -->
                    <div class="mb-6 flex flex-wrap gap-4">
                        @foreach (['export.pdf' => 'Download PDF', 'export.csv' => 'Download CSV'] as $route => $label)
                            <a href="{{ route($route) }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg shadow transition">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Welcome Message -->
                    <h3 class="text-lg font-semibold mb-4">Welcome, {{ $user->name }}</h3>

                    <!-- Recent Sentiment Analyses -->
                    <h3 class="text-lg font-semibold mb-4">Recent Sentiment Analyses</h3>

                    @if ($histories->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">No sentiment analyses available.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        @foreach (['Text', 'Sentiment', 'Positive Score', 'Negative Score', 'Neutral Score', 'Compound Score', 'Date'] as $header)
                                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">
                                                {{ $header }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($histories as $history)
                                        <tr class="border-t border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                            <a href="#" class="text-blue-500" onclick="alert('{{ addslashes($history->text) }}'); return false;">
        {{ Str::limit($history->text, 50) }}...
    </a>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                <span class="{{ $history->sentiment === 'Positive' ? 'text-green-500' : ($history->sentiment === 'Negative' ? 'text-red-500' : 'text-yellow-500') }}">
                                                    {{ $history->sentiment }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                {{ $history->positive_score }}%
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                {{ $history->negative_score }}%
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                {{ $history->neutral_score }}%
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                {{ $history->compound_score }}%
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                                {{ $history->created_at->format('Y-m-d H:i') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
