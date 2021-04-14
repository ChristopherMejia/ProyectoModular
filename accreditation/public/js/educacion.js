window.addEventListener('DOMContentLoaded', (event) => {

    document.addEventListener('click', (e) => {
        e = window.event;
        let target = e.target
        console.log(target);
    })
});
