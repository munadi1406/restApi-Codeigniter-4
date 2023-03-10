<!-- Tambahkan ini pada bagian head -->
<script>
  window.onload = function() {
    // Buat elemen form baru
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '<?= base_url("admin/link") ?>';

    // Tambahkan input hidden untuk film_id
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'film_id';
    input.value = '<?= $film_id ?>';
    form.appendChild(input);

    const submitBtn = document.createElement('button');
    submitBtn.type = 'submit';
    submitBtn.style.display = 'none';
    form.appendChild(submitBtn);
    document.body.appendChild(form);
    submitBtn.click();
  }
</script>
