console.log("Loaded preserve_scroll.js")

document.addEventListener("scroll", function() {
    let scroll = window.scrollY.toString();
    localStorage.setItem("scroll", scroll.toString());
    console.log("Saved", scroll);
})


window.addEventListener("load", function() {
    let scroll = localStorage.getItem("scroll");
    console.log("Scrolling to", scroll.toString());
    window.scrollTo(0, parseInt(scroll));
})
