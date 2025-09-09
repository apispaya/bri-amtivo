
// SweetAlert delete with Laravel form submit (or optional AJAX)
(function () {
  document.addEventListener("click", function (e) {
    const icon = e.target.closest(".trash-3, .trash-4, .trash-5, .trash-6, .trash-7, .trash-8, .trash-9, .trash-10, .trash-11, .trash-12, .trash-13, .trash-14, .trash-15, .trash-16, .trash-17");
    if (!icon) return;

    e.preventDefault();

    const row = icon.closest("tr");
    const form = icon.closest("form"); // <form method="POST">@csrf @method('DELETE') ...</form>

    const alertMessages = {
      "trash-3": "Do you really want to delete the product?",
      "trash-4": "Do you really want to delete the API Key?",
      "trash-5": "Do you really want to delete the Customer Review?",
      "trash-6": "Do you really want to delete the role?",
      "trash-7": "Do you really want to delete this user?",
      "trash-8": "Do you really want to delete this client?",
    };

    // Pick message based on class
    let alertMessage = "Do you really want to delete this item?";
    for (const className in alertMessages) {
      if (icon.classList.contains(className)) {
        alertMessage = alertMessages[className];
        break;
      }
    }

    Swal.fire({
      title: "Are you sure?",
      text: alertMessage,
      showCancelButton: true,
      confirmButtonColor: "#16C7F9",
      cancelButtonColor: "#FC4438",
      confirmButtonText: "Yes, delete!",
      imageUrl: "/assets/images/gif/trash.gif",
      imageWidth: 120,
      imageHeight: 120,
    }).then((result) => {
      if (!result.isConfirmed) return;

      // === Option A (default): submit the Laravel form ===
      if (form && icon.dataset.ajax !== "true") {
        form.submit(); // hits your DELETE route, handles flash/redirect server-side
        return;
      }

      // === Option B (AJAX): set data-ajax="true" on the delete button to use this path ===
      const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      const action = form?.action || icon.dataset.url; // allow data-url fallback if no form
      if (!action || !csrf) {
        // Fallback to full submit if something is missing
        if (form) form.submit();
        return;
      }

      // Build body from form so _token and _method=DELETE are included
      const body = form ? new URLSearchParams(new FormData(form)) : new URLSearchParams({ _token: csrf, _method: 'DELETE' });

      fetch(action, {
        method: 'POST',                 // method spoofing with _method=DELETE
        headers: {
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
        body
      })
        .then(async (r) => {
          if (!r.ok) {
            let msg = 'Tidak dapat memadam.';
            try { const j = await r.json(); msg = j.message || msg; } catch { }
            throw new Error(msg);
          }
          // Success → remove row and show toast
          row?.remove();
          Swal.fire({ icon: 'success', title: 'Dipadam', timer: 1200, showConfirmButton: false });
        })
        .catch((err) => {
          Swal.fire({ icon: 'error', title: 'Ralat', text: err.message || 'Sila cuba lagi.' });
        });
    });
  });
})();

