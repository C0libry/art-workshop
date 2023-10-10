let href = window.location.href;
let form = document.getElementById('bookingForm');
let order = document.getElementById('order')

order.addEventListener("click", show_form);
form.addEventListener('submit', booking_room);

console.log(href);
console.log('test');

$("#bookingForm").css("display", "none");

async function booking_room(event) {
    let formData = new FormData(form);
    event.preventDefault();
    const url = '/booking_room';
    const options = {
        method: 'POST',
        body: formData,
    };

    try {
        const response = await fetch(url, options);
        const result = await response.text();
        console.log(result);
        $("#bookingForm").css("display", "none");
        return result;
    } catch (error) {
        console.error(error);
    }
}

function show_form() {

    // Проверяем, что дата была выбрана
    if (!document.querySelector('.calendarev-day-selected')) {
        alert('Выберите дату');
        return;
    }

    // Формируем даты 
    let date = new Date();
    let now = new Date();

    // Заполняем даты
    date.setDate(+document.querySelector('.calendarev-day-selected').innerText);
    date.setMonth(+document.querySelector('.calendarev-month').value);
    date.setFullYear(+document.querySelector('.calendarev-years').value);
    now.setHours(0);

    // Проверка на выбранную дату
    if (now > date) {
        alert("Вы не можете записаться на прошедший день");
        return;
    }

    // document.querySelector('#booking').classList.remove("none");
    $("#bookingForm").css("display", "block");
    document.querySelector('#booking_date').value = date.toLocaleDateString();
    document.querySelector('.dateform').innerText = date.toLocaleDateString();
}