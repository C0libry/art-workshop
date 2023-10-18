document.querySelectorAll('#approve-form').forEach(function (elem) {
    elem.addEventListener('submit', approve);
});
document.querySelectorAll('#delete-room-form').forEach(function (elem) {
    elem.addEventListener('submit', delete_room);
});
document.querySelectorAll('.update-room').forEach(function (elem) {
    elem.addEventListener('click', update_room);
});

let add_room_pop_up = document.querySelector('#add-room-pop-up');
let update_room_pop_up = document.querySelector('#update-room-pop-up');

add_room_pop_up.style.display = "none";
add_room_pop_up.addEventListener('click', close_pop_up);

update_room_pop_up.style.display = "none";
update_room_pop_up.addEventListener('click', close_pop_up);

async function approve(event) {
    let formData = new FormData(event.target);
    event.preventDefault();
    const url = '/booking_approve';
    const options = {
        method: 'POST',
        body: formData,
    };

    try {
        const response = await fetch(url, options);
        const result = await response.text();
        if (response.status !== 200) {
            console.error(result);
            return result;
        }
        let status = event.target.parentElement.parentElement.querySelector('.status');
        if (result) {
            status.innerHTML = 'Подержено';
            event.target.querySelector('ion-icon').setAttribute('name', 'close-outline');
        }
        else {
            status.innerHTML = 'Не подержено';
            event.target.querySelector('ion-icon').setAttribute('name', 'checkmark-outline');
        }
        return result;
    } catch (error) {
        console.error(error);
    }
}

async function delete_room(event) {
    let id = event.target.room_id;
    let formData = new FormData(event.target);
    event.preventDefault();
    const url = '/delete_room';
    const options = {
        method: 'POST',
        body: formData,
    };

    try {
        const response = await fetch(url, options);
        const result = await response.text();
        if (response.status !== 200) {
            console.error(result);
            return result;
        }
        event.target.parentElement.parentElement.remove();
        return result;
    } catch (error) {
        console.error(error);
    }
}

function show_add_room_form(event) {
    add_room_pop_up.style.display = "flex";
}

function close_pop_up(event) {
    if(event.target.classList.contains('pop-up-wrapper')) {
        event.target.style.display = "none";
    }
}

function update_room(event) {
    update_room_pop_up.style.display = "flex";
    let data = event.target.parentElement;
    console.log(data);
    document.querySelector('#room-id-update').value = data.querySelector('#id').innerText;
    document.querySelector('#room-address-update').value = data.querySelector('#address').innerText;
    document.querySelector('#room-name-update').value = data.querySelector('#name').innerText;
    document.querySelector('#room-description-update').value = data.querySelector('#description').innerText;
}