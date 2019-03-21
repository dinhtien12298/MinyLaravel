var subMenu = document.getElementsByClassName("sub-menu");
var layerOpacity = document.getElementById("layer-opacity");
var subject = document.getElementsByClassName("subject");
let body = document.getElementsByTagName("body")[0];

if (window.outerWidth > 768) {
    if (subMenu.length > 1) {
        for (i = 1; i < subMenu.length; i++) {
            subMenu[i].style.marginLeft = "-1px";
        }
    }

    function menuAppear() {
        layerOpacity.style.height = body.clientHeight + "px";
    }

    function menuDisappear() {
        layerOpacity.style.height = "0px";
    }
}

function isDisplay() {
    layerOpacity.style.height = body.clientHeight + "px";
    setTimeout(function() {
        document.getElementById("nav").style.marginLeft = "0";
        layerOpacity.style.marginLeft = "0";
        body.style.overflow = "hidden";
    }, 1);
}

function isHidden() {
    document.getElementById("nav").style.marginLeft = `-${0.7 * body.clientWidth}px`;
    layerOpacity.style.marginLeft = "-100%";
    body.style.overflow = "unset";
    setTimeout(function() {
        layerOpacity.style.height = "0";
    }, 1000);
}

for (let i = 0; i < subMenu.length; i++) {
    if (i < subMenu.length && i > subMenu.length - 4 && window.outerWidth > 768) {
        subject[i].style.marginLeft = "-222%";
    }
    subMenu[i].onclick = function() {
        var current = subMenu[i];
        var list_menu_active = document.getElementsByClassName('menu-active');
        if (list_menu_active.length) {
            for (let i = 0; i < list_menu_active.length; i++) {
                if (current == list_menu_active[i]) { continue };
                list_menu_active[i].classList.remove('menu-active');
            }
        }

        if(current.classList.contains('menu-active')){
            current.classList.remove('menu-active');
        }
        else {
            current.classList.add('menu-active');
        }
    }
}

// Scroll to Top
if (document.getElementById("scroll-top")) {
    var scrollTopButton = document.getElementById("scroll-top");
    var html = document.documentElement;

    window.onscroll = function() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollTopButton.style.display = "block";
        } else {
            scrollTopButton.style.display = "none";
        }
    };

    function scrollToTop(totalTime, easingPower) {
        var timeLeft = totalTime;
        var scrollByPixel = setInterval(function () {
            var percentSpent = (totalTime - timeLeft) / totalTime;
            if (timeLeft >= 0) {
                var newScrollTop = html.scrollTop * (1 - Math.pow(percentSpent, easingPower));
                html.scrollTop = newScrollTop;
                timeLeft--;
            } else {
                clearInterval(scrollByPixel);
            }
        }, 1);
    }
}

// Border in Footer Menu Tab
var footerMenuItem = document.getElementsByClassName("footer-menu-item");

if (footerMenuItem.length > 1) {
    footerMenuItem[1].classList.add('border-footer');
    for (i = 2; i < footerMenuItem.length - 1; i++) {
        footerMenuItem[i].classList.add('border-footer');
        footerMenuItem[i].style.marginLeft = "-1px";
    }
}

// Link breadcrumbs
var breadcrumbTags = document.getElementsByClassName('breadcrumb-tag');

for (let i = 0; i < breadcrumbTags.length; i++) {
    breadcrumbTags[i].onclick = function() {
        if (i == 0) {
            window.location.href = `/`;
        }
        else if (i == 1) {
            window.location.href = `/danh-muc/${breadcrumbTags[1].innerHTML}`;
        }
        else if (i == 2) {
            window.location.href = `/danh-muc/${breadcrumbTags[1].innerHTML}/${breadcrumbTags[2].innerHTML}/1`;
        }
    }
}

// Searching
if (document.getElementById('search')) {
    const searchBar = document.getElementById('search');
    var searchContent = document.getElementsByClassName('search-content')[0];
    searchBar.oninput = function () {
        var keyword = (searchBar.value.length > 0) ? searchBar.value : '****';
        axios({
            method: 'GET',
            url: `tim-kiem-bai-viet/${ keyword }`
        }).then(response => {
            if (response.data && response.data.length > 0) {
                var posts = response.data;
                var postHTML = posts.map(
                    post => `<a class="found-post" data-postId="${ post['id'] }" onclick="directTo('/bai-viet/${ post['id'] }')"><p>${ post['title'] }</p></a>`
                );
                searchContent.innerHTML = `${postHTML.join("")}`;
            }
            if (searchBar.value.length < 1 || response.data.length < 1) {
                searchContent.innerHTML = ``;
            }
        }).catch(error => { console.log(error) });
    }
}

function directTo(place) {
    window.location.href = place;
    searchContent.innerHTML = ``;
}

// logOut
function logOut() {
    var confirmCheck = confirm('Bạn có chắc chắn muốn đăng xuất?');
    if (confirmCheck) {
        window.location.href = '/dang-xuat';
    }
}