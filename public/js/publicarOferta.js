document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("btnPublicar");
    const msg = document.getElementById("msgPublicar");

    if (!btn) return;

    btn.addEventListener("click", (event) => {
        event.preventDefault();

        const titulo = document.getElementById("titulo").value.trim();
        const descripcion = document.getElementById("descripcion").value.trim();
        const requisitos = document.getElementById("requisitos").value.trim();

        if (!titulo || !descripcion) {
            msg.innerHTML = '<div class="alert alert-warning">Título y descripción son obligatorios.</div>';
            return;
        }

        btn.disabled = true;
        btn.innerText = "Publicando...";

        const fd = new FormData();
        fd.append("option", "publicarOferta");
        fd.append("titulo", titulo);
        fd.append("descripcion", descripcion);
        fd.append("requisitos", requisitos);

        fetch(BASE_URL + "/index.php", {
            method: "POST",
            body: fd
        })
            .then(response => {
                if (!response.ok) throw new Error("Error de red");
                return response.json();
            })
            .then(data => {
                if (data.response === "00") {
                    msg.innerHTML = '<div class="alert alert-success">¡Oferta publicada!</div>';
                    document.getElementById("titulo").value = "";
                    document.getElementById("descripcion").value = "";
                    document.getElementById("requisitos").value = "";
                } else {
                    msg.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                }
            })
            .catch(error => {
                console.error(error);
                msg.innerHTML = '<div class="alert alert-danger">Error de conexión con el servidor.</div>';
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerText = "Publicar";
            });
    });
});