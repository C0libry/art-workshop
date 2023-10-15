@extends('layout')

@section('head')
    <title>Admin</title>
    <script type="text/javascript" src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('main_content')
    <main>
        <table id="rooms" class="my-table my-table-margin">
            <thead>
                <tr>
                    <th rowspan="1">id</th>
                    <th rowspan="1">Название</th>
                    <th rowspan="1">Адрес</th>
                    <th colspan="1">Описание</th>
                    <th colspan="1">Изиображение</th>
                    <th colspan="1">Удалить</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <th>{{ $room->id }}</th>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->address }}</td>
                        <td>{{ $room->description }}</td>
                        <td><img src="{{ $room->image }}" alt=""></td>
                        <td>
                            <form id="delete-room-form">
                                @csrf
                                @method('DELETE')
                                <input id="room_id" type="hidden" name="room_id" value="{{ $room->id }}">
                                <button class="delete-room-btn">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form id="add_room">
            @csrf
        </form>
        <form id="update_room">
            @csrf
        </form>
        <table class="my-table my-table-margin">
            <thead>
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
                            <form id="approve-form">
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
