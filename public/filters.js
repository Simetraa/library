console.log("Loading filters.js")

let subjectDivs = document.querySelectorAll(".genre-filters > div");
subjectDivs.forEach(subjectDiv => {
    let subjectCheckbox = subjectDiv.querySelector("input");

    subjectCheckbox.addEventListener("change", function() {
        let categoryCheckboxes = subjectDiv.querySelectorAll("div > input");
        categoryCheckboxes.forEach(categoryCheckbox => {
            categoryCheckbox.checked = subjectCheckbox.checked;
        })
    })
})

let inputElements = document.querySelectorAll(".genre-filters input");
inputElements.forEach(input => {
    input.addEventListener("change", function() {
        this.form.submit();
    })
})

let genreFilterForm = document.querySelector(".genre-filter-form");
let searchAndSortForm = document.querySelector(".search-sort-by");
let dropdownForm = document.querySelector("#dropdown");

dropdownForm.addEventListener("change", function() {
    this.form.submit();
})

// genreFilterForm.addEventListener('onchange', submit);
// dropdownForm.addEventListener('onchange', submit);
//
// function submit() {
//     let data = new FormData(genreFilterForm);
//     let searchData = new FormData(searchAndSortForm);
//     console.log(searchData);
//
//     for(let d of searchData) {
//         data.append(d.name, d.value);
//     }
//     let forms = document.forms;
//
//     let req = fetch("/", {
//         body: new FormData(data),
//     })
// }


