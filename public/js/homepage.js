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
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(49);


/***/ }),

/***/ 49:
/***/ (function(module, exports) {

var subjectTab = document.getElementsByClassName('subject-tab');
var tabPost = document.getElementsByClassName('tab-post');

var _loop = function _loop(i) {
    if (i == 0 || i == 4) {
        subjectTab[i].classList.add('subject-active');
    }
    subjectTab[i].onclick = function () {
        var subjectActive = document.getElementsByClassName('subject-active');
        for (var j = 0; j < subjectActive.length; j++) {
            if (j == parseInt(i / 4)) {
                subjectActive[j].classList.remove('subject-active');
            }
        }
        subjectTab[i].classList.add('subject-active');

        var _loop2 = function _loop2(k) {
            if (k == parseInt(i / 4) + 1) {
                axios({
                    method: 'GET',
                    url: "/App/Api/TabPostApi.php",
                    params: {
                        "subjectid": subjectTab[i].dataset.subjectid
                    }
                }).then(function (response) {
                    if (response.data) {
                        var posts = response.data;
                        var tabPostHTML = posts.map(function (post) {
                            return '\n                            <div class="post-model" onclick="directTo(\'/bai-viet/' + post.id + '\')">\n                                <div class="post-title">\n                                    <a href="/bai-viet/' + post.id + '" class="f-medium-17">' + post.title + '</a>\n                                </div>\n                                <div class="post-heading d-flex">\n                                    <div class="post-author f-medium-12">\n                                        ' + post.fullname + '\n                                    </div>\n                                    <div class="post-info f-regular-13">\n                                        <div><img src="/images/homepage/icon-view.png" alt="icon-view">' + post.view_num + '</div>\n                                        <div><img src="/images/homepage/icon-heart.png" alt="icon-like">' + post.like_num + '</div>\n                                    </div>\n                                </div>\n                                <div class="post-content f-regular-13">\n                                    ' + post.content + '\n                                </div>\n                            </div>\n                        ';
                        });
                        tabPost[k].innerHTML = '' + tabPostHTML.join("");
                    }
                }).catch(function (error) {
                    return console.log(error);
                });
            }
        };

        for (var k = 0; k < tabPost.length; k++) {
            _loop2(k);
        }
    };
};

for (var i = 0; i < subjectTab.length; i++) {
    _loop(i);
}

/***/ })

/******/ });