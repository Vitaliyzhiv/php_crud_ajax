// If some elements appears on the page after the page is loaded then we should use event deligation from 
// already created elements
// Create function with event deligation
const divTable = document.querySelector('.table-responsive');
// Delegate events

divTable.addEventListener('click', (event) => {
    if (event.target.classList.contains('page-link')) {
        // pagination
        event.preventDefault();
        let page = +event.target.dataset.page;
        // if page
        if (page) {
            fetch('actions.php', {
                method: 'POST',
                body: JSON.stringify({ page: page })
            })
                .then((response) => response.text())
                .then((data) => {
                    // Insert data into HTML
                    document.querySelector('.table-responsive').innerHTML = data;
                });
        }
    }

    // get city for edit
    let editButton = event.target.closest('.btn-edit');
    if (editButton) {
        let id = editButton.dataset.id;
        // get city data from id
        if (id) {
            fetch('actions.php', {
                method: 'POST',
                body: JSON.stringify({ id: id, action: 'get_city' })
            })
                .then((response) => response.json())
                .then((data) => {
                    // fill fields with actual city data
                    if (data.answer === 'success') {
                        document.getElementById('editName').value = data.city.name;
                        document.getElementById('editPopulation').value = data.city.population;
                        document.getElementById('id').value = data.city.id;
                    }
                });
        }
    }

    // delete city
    let deleteButton = event.target.closest('.btn-delete');
    if (deleteButton) {
        let id = deleteButton.dataset.id;
        // get city data from id
        if (id) {
            fetch('actions.php', {
                method: 'POST',
                body: JSON.stringify({ id: id, action: 'delete_city' })
            })
                .then((response) => response.json())
                .then((data) => {
                    // show message and delete city
                    if (data.answer === 'success') {
                        // settimeout
                        setTimeout(() => {
                            Swal.fire({
                                icon: data.answer,
                                title: data.answer,
                                html: data?.errors,
                            });
                            // reset form if answer is success
                            if (data.answer === 'success') {
                                // get tr
                                let tr = document.getElementById(`city-${id}`);
                                // remove tr
                                tr.remove();

                            }

                        }, 1000);

                    }
                });
        }
    }
});

// Add city
addCityForm = document.getElementById('addCityForm');
btnEditSubmit = document.getElementById('btn-edit-submit');


// Add city form
addCityForm.addEventListener('submit', (event) => {
    event.preventDefault();
    // Change text on button after saving
    btnAddSubmit.textContent = 'Saving...';
    // disable button for prevent multiple clicks
    btnAddSubmit.disabled = true;
    // send data
    fetch('actions.php', {
        method: 'POST',
        // Send data using class which allows to send form data
        body: new FormData(addCityForm)
    })
        .then((response) => response.json())
        .then((data) => {
            // settimeout
            setTimeout(() => {
                Swal.fire({
                    icon: data.answer,
                    title: data.answer,
                    html: data?.errors,
                });
                // reset form if answer is success
                if (data.answer === 'success') {
                    addCityForm.reset();
                }
                // unlock button 
                btnAddSubmit.textContent = 'Add City';
                btnAddSubmit.disabled = false;
            }, 1000);


        });



});

// Edit city form
editCityForm = document.getElementById('editCityForm');
btnAddSubmit = document.getElementById('btn-add-submit');

editCityForm.addEventListener('submit', (event) => {
    event.preventDefault();
    // Change text on button after saving
    btnEditSubmit.textContent = 'Saving...';
    // disable button for prevent multiple clicks
    btnEditSubmit.disabled = true;
    // send data
    fetch('actions.php', {
        method: 'POST',
        // Send data using class which allows to send form data
        body: new FormData(editCityForm)
    })
        .then((response) => response.json())
        .then((data) => {
            // settimeout
            setTimeout(() => {
                Swal.fire({
                    icon: data.answer,
                    title: data.answer,
                    html: data?.errors,
                });
                // reset form if answer is success
                if (data.answer === 'success') {
                    // get the fields data to insert them on page and replace previous fields
                    // get id
                    let idValue = document.getElementById('id').value;
                    // get name
                    let nameValue = document.getElementById('editName').value;
                    // get population
                    let populationValue = document.getElementById('editPopulation').value;
                    // get tr
                    let tr = document.getElementById(`city-${idValue}`);
                    // get td
                    tr.querySelector('.name').innerHTML = nameValue;
                    tr.querySelector('.population').innerHTML = populationValue;
                }
                // unlock button 
                btnEditSubmit.textContent = 'Edit City';
                btnEditSubmit.disabled = false;
            }, 1000);


        });



});
