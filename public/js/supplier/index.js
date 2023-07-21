document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll("#delete-supplier");

    deleteButtons.forEach(function (deleteButton) {
        deleteButton.addEventListener('click', function (e) {
            e.preventDefault();

            const supplierId = this.dataset.supplierId;
            const deleteUrl = this.dataset.deleteUrl;

            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                data: { id: supplierId },
                success: function (response) {
                    console.log(response, response.currentPage)
                    alert(response.message)
                    const currentPage = response.currentPage;
                    setTimeout(function () {
                        window.location.href = `/home?page=${currentPage}`;
                    }, 500);
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText)
                    alert(`Error al eliminar el proveïdor: ${textStatus} ${errorThrown}`)
                    setTimeout(function () {
                        window.location.reload();
                    }, 500);
                }
            });
        });
    });
});