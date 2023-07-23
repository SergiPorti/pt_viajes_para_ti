document.addEventListener('DOMContentLoaded', function () {
    const updateButton = document.getElementById("update-button");

    updateButton.addEventListener('click', function (e) {
        e.preventDefault();
        console.log('TAPPED');

        const urlParams = new URLSearchParams(window.location.search);
        const supplierId = urlParams.get('id');
        const currentPage = urlParams.get('page');

        let name = document.getElementById('name').value
        const email = document.getElementById('email').value
        const phoneNumber = document.getElementById('phoneNumber').value
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
            url: '/update/supplier',
            type: 'PUT',
            data: {
                id: supplierId,
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
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr.responseText)
                alert(`Error al actualitzar el proveïdor: ${textStatus} ${errorThrown}`)
                setTimeout(function () {
                    window.location.reload();
                }, 500);
            }
        });
    });
});

function validateForm(phoneNumber, supplierType, isActive) {
    return phoneNumber.length <= 20 && supplierType.length <= 20 && typeof isActive === 'boolean' && validateSupplierType(supplierType);
}

function validateSupplierType(supplierType) {
    supplierType = supplierType.toLowerCase();
    return supplierType === "hotel" || supplierType === "pista" || supplierType === "complemento";
}

function escapeString(str) {
    return str.replace(/[<>&"'\\]/g, char => {
        switch (char) {
            case '<':
                return '&lt;';
            case '>':
                return '&gt;';
            case '&':
                return '&amp;';
            case '"':
                return '&quot;';
            case "'":
                return '&#39;';
            case '\\':
                return '&#92;';
            default:
                return char;
        }
    });
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}