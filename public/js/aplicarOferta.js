document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("btnAplicar");

    if (!btn) return;

    btn.addEventListener("click", function (event) {
        event.preventDefault();

        const fd = new FormData();
        fd.append("option", "aplicarOferta");
        fd.append("idOferta", this.dataset.id);

        fetch(BASE_URL + "/index.php", {
            method: "POST",
            body: fd
        })
            .then(response => response.json())
            .then(data => {
                const msg = document.getElementById("msgAplicar");

                if (data.response === "00") {
                    msg.innerHTML = '<div class="alert alert-success">¡Postulación enviada!</div>';
                    btn.disabled = true;
                } else {
                    msg.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
    });
});