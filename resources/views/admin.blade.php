@extends('layout')

@section('head')
    <title>Admin</title>
    <script type="text/javascript" src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('main_content')
    <main>
        <form id="add_room">
            @csrf
        </form>
        <form id="update_room">
            @csrf
        </form>
        <table class="my-table">
            <thead>
                <!-- Заголовки -->
                <tr>
                    <th rowspan="1">id</th>
                    <th rowspan="1">ФИО</th>
                    <th rowspan="1">Начало</th>
                    <th colspan="1">Конец</th>
                    <th colspan="1">Возраст</th>
                    <th colspan="1">Институт</th>
                    <th colspan="1">Изменить статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($booking as $book)
                    <tr>
                        <th>{{ $book->id }}</th>
                        <td>{{ $book->fullname }}</td>
                        <td>{{ $book->booking_start }}</td>
                        <td>{{ $book->booking_end }}</td>
                        <td>{{ $book->age }}</td>
                        <td>{{ $book->institute }}</td>
                        <td>
                            <form id="approve_form">
                                @csrf
                                @method('PATCH')
                                <input id="book_id" type="hidden" name="book_id" value="{{ $book->id }}">
                                <button class="approve-btn">
                                    @if ($book->approved)
                                        <ion-icon name="close-outline"></ion-icon>
                                    @else
                                        <ion-icon name="checkmark-outline"></ion-icon>
                                    @endif
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
