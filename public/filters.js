console.log("Loading filters.js")

let subjectDivs = document.querySelectorAll(".genre-filter-form > div");
console.log(document.querySelector(".genre-filter-form"));

subjectDivs.forEach(subjectDiv => {
    let subjectCheckbox = subjectDiv.querySelector("input");

    subjectCheckbox.addEventListener("change", function() {
        let categoryCheckboxes = subjectDiv.querySelectorAll("div > input");
        categoryCheckboxes.forEach(categoryCheckbox => {
            categoryCheckbox.checked = subjectCheckbox.checked;
        })
    })
})

let inputElements = document.querySelectorAll(".genre-filter-form input");
inputElements.forEach(input => {
    input.addEventListener("change", function() {
        this.form.submit();
    })
})


