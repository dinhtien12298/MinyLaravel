// Active Pagination button
var paginateButton = document.getElementsByClassName('paginate-button');
const query = new URL(window.location.href).href.split("/");
if (paginateButton.length > 0) {
    const page = query[query.length - 1];
    paginateButton[page-1].classList.add('active-pagination-button');
}
