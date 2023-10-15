document.querySelectorAll('#approve-form').forEach(function (elem) {
    elem.addEventListener('submit', approve);
});
document.querySelectorAll('#delete-room-form').forEach(function (elem) {
    elem.addEventListener('submit', delete_room);
});

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
        if (result)
            event.target.querySelector('ion-icon').setAttribute('name', 'close-outline');
        else
            event.target.querySelector('ion-icon').setAttribute('name', 'checkmark-outline');
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
