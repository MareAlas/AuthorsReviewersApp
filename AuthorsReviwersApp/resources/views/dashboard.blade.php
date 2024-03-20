<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Naslov</th>
                                <th>Sadržaj</th>
                                <th>Status</th>
                                <th>Authors</th>
                                @if(auth()->user()->role_id == 1)
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->content }}</td>
                                <td>{{ $article->status }}</td>
                                <td>
                                    @foreach ($article->authors as $author)
                                        {{ $author->name }}{{ $loop->last ? '' : ', ' }}
                                    @endforeach
                                </td>
                                @if(auth()->user()->role_id == 1)
                                <td>
                                    @if($article->status == 'pending')
                                    <form action="{{ route('article.approve', $article->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit">Approve</button>
                                    </form>
                                    @elseif($article->status == 'approved')
                                    <form action="{{ route('articles.publish', $article) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit">Publish</button>
                                    </form>
                                    @endif
                                    <form action="{{ route('article.reject', $article->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit">Reject</button>
                                    </form>
                                </td>
                            @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div><a href="{{ route('reviewer.statistics') }}">Statistics</a></div>
    </div>
</x-app-layout>
