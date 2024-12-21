let bookIdInputElement = document.getElementById('book-id-input')
let bookIdList = document.getElementById('book-id-list');
let bookIdTemplate = document.getElementById('book-id-template');

console.log(bookIdInputElement);
bookIdInputElement.onsubmit = function(event) {
    console.log("hi");
}
bookIdInputElement.addEventListener('submit', function(event) {
    console.log("hi")
    let template = bookIdTemplate.content.cloneNode(true);
    template.querySelector('#book-id-label').textContent = bookIdInputElement.value;
    template.querySelector('#book-id-cancel-button').addEventListener('click', function() {
        this.parent.remove();
    })

    bookIdList.append(template)


    event.preventDefault();
})
