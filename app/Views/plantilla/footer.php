</div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    const eliminaModal = document.getElementById('eliminaModal')
    if (eliminaModal) {
        eliminaModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const url = button.getAttribute('data-bs-url')

            // Update the modal's content.
            const form = eliminaModal.querySelector('#form-elimina')
            form.setAttribute('action', url)
        })
    }
</script>
</body>

</html>