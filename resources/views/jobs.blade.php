<x-layout>
    <x-slot:heading>Jobs listing</x-slot:heading>
    <h1>Jobs</h1>

    <ul>
        @foreach ($jobs as $job)
            <li>
                <a href="jobs/{{ $job['id'] }}" class="text-blue-500 hover:underline">
                    {{ $job['title'] }}, Pays: {{ $job['salary'] }}
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>