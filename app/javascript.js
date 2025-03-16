
let form = document.getElementById('gameForm');

let addButton = document.getElementById('add-button');

addButton.addEventListener('click', function () {

    if (form.style.display == 'none') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
})