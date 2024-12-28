let dropdownForm = document.querySelector("select");

dropdownForm.addEventListener("change", function() {
    this.form.submit();
})
