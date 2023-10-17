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
        <button class="my-btn" id="add-room-btn" onclick="show_add_room_form()">Добавить аудиторию</button>
        <div id="add-room-pop-up" class="pop-up-wrapper">
            <form id="add-room-form" class="pop-up-form" method="POST" action="{{ route('room.create') }}" enctype="multipart/form-data">
                @csrf
                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Добавить аудиторию</p>
                <input class="form-control block mt-1 w-full" id="room-name" name="name" value="" required>
                <label class="form-label">Название аудитории</label>

                <input class="form-control block mt-1 w-full" id="room-address" name="address" value="" required>
                <label class="form-label">Адрес аудитории</label>

                <input class="form-control block mt-1 w-full" id="room-description" name="description" value="">
                <label class="form-label">Описание аудитории</label>

                <input type="file" class="form-control block mt-1 w-full" id="room-image" name="image">
                <label class="form-label">Фото аудитории</label>

                <button class="my-btn my-btn-margin">Добавить</button>
            </form>
        </div>
        {{-- <div id="update-room-pop-up" class="pop-up-wrapper">
            <form id="update-room" clas="pop-up-form">
                @csrf
            </form>
        </div> --}}
        <table class="my-table my-table-margin">
            <thead>
                <tr>
                    <th rowspan="1">id</th>
                    <th rowspan="1">Аудитория</th>
                    <th rowspan="1">ФИО</th>
                    <th rowspan="1">Начало</th>
                    <th colspan="1">Конец</th>
                    <th colspan="1">Возраст</th>
                    <th colspan="1">Институт</th>
                    <th colspan="1">Статус</th>
                    <th colspan="1">Изменить статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($booking as $book)
                    <tr>
                        <th>{{ $book->id }}</th>
                        <td>{{ $book->room->name }}</td>
                        <td>{{ $book->fullname }}</td>
                        <td>{{ $book->booking_start }}</td>
                        <td>{{ $book->booking_end }}</td>
                        <td>{{ $book->age }}</td>
                        <td>{{ $book->institute }}</td>
                        <td class="status">
                            @if ($book->approved)
                                Подержено
                            @else
                                Не подержено
                            @endif
                        </td>
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
