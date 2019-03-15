/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 52);
/******/ })
/************************************************************************/
/******/ ({

/***/ 52:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(53);


/***/ }),

/***/ 53:
/***/ (function(module, exports) {

var subMenu = document.getElementsByClassName("sub-menu");
var layerOpacity = document.getElementById("layer-opacity");
var subject = document.getElementsByClassName("subject");
var body = document.getElementsByTagName("body")[0];

if (window.outerWidth > 768) {
    var menuAppear = function menuAppear() {
        layerOpacity.style.height = body.clientHeight + "px";
    };

    var menuDisappear = function menuDisappear() {
        layerOpacity.style.height = "0px";
    };

    if (subMenu.length > 1) {
        for (i = 1; i < subMenu.length; i++) {
            subMenu[i].style.marginLeft = "-1px";
        }
    }
}

function isDisplay() {
    layerOpacity.style.height = body.clientHeight + "px";
    setTimeout(function () {
        document.getElementById("nav").style.marginLeft = "0";
        layerOpacity.style.marginLeft = "0";
        body.style.overflow = "hidden";
    }, 1);
}

function isHidden() {
    document.getElementById("nav").style.marginLeft = "-" + 0.7 * body.clientWidth + "px";
    layerOpacity.style.marginLeft = "-100%";
    body.style.overflow = "unset";
    setTimeout(function () {
        layerOpacity.style.height = "0";
    }, 1000);
}

var _loop = function _loop(_i) {
    if (_i < subMenu.length && _i > subMenu.length - 4 && window.outerWidth > 768) {
        subject[_i].style.marginLeft = "-222%";
    }
    subMenu[_i].onclick = function () {
        var current = subMenu[_i];
        var list_menu_active = document.getElementsByClassName('menu-active');
        if (list_menu_active.length) {
            for (var _i3 = 0; _i3 < list_menu_active.length; _i3++) {
                if (current == list_menu_active[_i3]) {
                    continue;
                };
                list_menu_active[_i3].classList.remove('menu-active');
            }
        }

        if (current.classList.contains('menu-active')) {
            current.classList.remove('menu-active');
        } else {
            current.classList.add('menu-active');
        }
    };
};

for (var _i = 0; _i < subMenu.length; _i++) {
    _loop(_i);
}

// Scroll to Top
if (document.getElementById("scroll-top")) {
    var scrollToTop = function scrollToTop(totalTime, easingPower) {
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
    };

    var scrollTopButton = document.getElementById("scroll-top");
    var html = document.documentElement;

    window.onscroll = function () {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollTopButton.style.display = "block";
        } else {
            scrollTopButton.style.display = "none";
        }
    };
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

var _loop2 = function _loop2(_i2) {
    breadcrumbTags[_i2].onclick = function () {
        if (_i2 == 0) {
            window.location.href = "/";
        } else if (_i2 == 1) {
            window.location.href = "/danh-muc/" + breadcrumbTags[1].innerHTML;
        } else if (_i2 == 2) {
            window.location.href = "/danh-muc/" + breadcrumbTags[1].innerHTML + "/" + breadcrumbTags[2].innerHTML + "/1";
        }
    };
};

for (var _i2 = 0; _i2 < breadcrumbTags.length; _i2++) {
    _loop2(_i2);
}

// Searching
if (document.getElementById('search')) {
    var searchBar = document.getElementById('search');
    var searchContent = document.getElementsByClassName('search-content')[0];
    searchBar.oninput = function () {
        axios({
            method: 'GET',
            url: "/App/Api/SearchPostApi.php",
            params: { "keyword": searchBar.value }
        }).then(function (response) {
            if (response.data && response.data.length > 0) {
                var posts = response.data;
                var postHTML = posts.map(function (post) {
                    return "<a class=\"found-post\" data-postId=\"" + post['id'] + "\" onclick=\"directTo('/bai-viet/" + post['id'] + "')\"><p>" + post['title'] + "</p></a>";
                });
                searchContent.innerHTML = "" + postHTML.join("");
            }
            if (searchBar.value.length < 1 || response.data.length < 1) {
                searchContent.innerHTML = "";
            }
        }).catch(function (error) {
            console.log(error);
        });
    };
}

function directTo(place) {
    window.location.href = place;
    searchContent.innerHTML = "";
}

// logOut
function logOut() {
    var confirmCheck = confirm('Bạn có chắc chắn muốn đăng xuất?');
    if (confirmCheck) {
        window.location.href = '/dang-xuat';
    }
}

/***/ })

/******/ });