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
                body: JSON.stringify({page: page})
            })
            .then((response) => response.text())
            .then((data) => {
                // Insert data into HTML
                document.querySelector('.table-responsive').innerHTML = data;
            });
        }
    }
});

// Add city
addCityForm = document.getElementById('addCityForm');
btnAddSubmit = document.getElementById('btn-add-submit');

// Add event listener on addCityForm for form sending without reloading

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
        setTimeout( () => {
            Swal.fire({
                icon: data.answer,
                title: data.answer,
                html: data?.errors,
              });
            // reset form if answer is success
            if (data.answer ==='success') {
                addCityForm.reset();
            }
            // unlock button 
            btnAddSubmit.textContent = 'Add City';
            btnAddSubmit.disabled = false;
        }, 1000);

       
    });

});

