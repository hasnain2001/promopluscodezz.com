<x-app-layout>
    <h2 class="text-xl font-bold mb-4">Start Chat With:</h2>
    <ul>
        @foreach ($users as $user)
            <li class="mb-2">
                <a href="{{ route('chat', $user->id) }}" class="text-blue-600 hover:underline">
                    {{ $user->name }}
                </a>
            </li>
        @endforeach
    </ul>
</x-app-layout>
