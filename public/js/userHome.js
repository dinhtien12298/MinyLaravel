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
/******/ 	return __webpack_require__(__webpack_require__.s = 54);
/******/ })
/************************************************************************/
/******/ ({

/***/ 54:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(55);


/***/ }),

/***/ 55:
/***/ (function(module, exports) {

// searchSubjectsAPI for creating post
var classInput = document.getElementsByClassName('class-input')[0];
var subjectInput = document.getElementsByClassName('subject-input')[0];

if (classInput) {
    searchSubjectsOfClass(classInput.value);
    classInput.onchange = function () {
        searchSubjectsOfClass(classInput.value);
    };
}

function searchSubjectsOfClass(class_name) {
    axios({
        method: 'GET',
        url: '/App/Api/SearchSubjectApi.php',
        params: { "class": class_name }
    }).then(function (response) {
        if (response.data && response.data.length > 0) {
            var data = response.data;
            var subjectInputHTML = data.map(function (obj) {
                return '<option value="' + obj['subject'] + '">' + obj['subject'] + '</option>';
            });
            subjectInput.innerHTML = '' + subjectInputHTML.join("");
        }
    }).catch(function (error) {
        return console.log(error);
    });
}

// deletePostAPI
function deletePost(post_id, index) {
    var confirmCheck = confirm('Bạn có chắc chắn muốn xóa bài viết');
    if (confirmCheck) {
        var postTable = document.getElementsByTagName('table')[0];
        var saveContent = postTable.innerHTML;
        var removeContent = document.getElementsByTagName('tr')[index + 1].innerHTML;
        axios({
            method: 'GET',
            url: '/App/Api/DeletePostApi.php',
            params: { 'post_id': post_id }
        }).then(function (response) {
            if (response.data) {
                postTable.innerHTML = saveContent.replace(removeContent, '');
                alert(response.data);
            }
        }).catch(function (error) {
            return console.log(error);
        });
    }
}

/***/ })

/******/ });