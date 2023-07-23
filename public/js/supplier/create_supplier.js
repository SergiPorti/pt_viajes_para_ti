import { escapeString, isValidEmail, validateForm } from './update_supplier.js';

function handleCreateSupplier() {

    const createButton = document.getElementById("create-button");

    const currentPage = new URLSearchParams(window.location.search).get('page');
    console.log(currentPage)

    createButton.addEventListener('click', function (e) {
        e.preventDefault();
        console.log('TAPPED');

        let name = document.getElementById('name').value
        const email = document.getElementById('email').value
        let phoneNumber = document.getElementById('phoneNumber').value
        const supplierType = document.getElementById('supplierType').value
        const isActive = document.getElementById('isActive').checked

        if (!isValidEmail(email)) {
            return alert('El correu introduït no és vàlid');
        }

        if (!validateForm(phoneNumber, supplierType, isActive)) {
            return alert('El número de telèfon o el tipus de proveïdor no és vàlid');
        }

        name = escapeString(name);
        phoneNumber = escapeString(phoneNumber);

        $.ajax({
            url: '/create/supplier',
            type: 'POST',
            data: {
                name: name,
                email: email,
                phoneNumber: phoneNumber,
                supplierType: supplierType,
                isActive: isActive
            },
            success: function (response) {
                alert(response.message)
                setTimeout(function () {
                    window.location.href = `/home?page=${currentPage}`;
                }, 500);
            },
            error: function (response) {
                alert(response.message, response.error_message);
                setTimeout(function () {
                    window.location.reload();
                }, 500);
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', handleCreateSupplier);