// searchSubjectsAPI for creating post
const classInput = document.getElementsByClassName('class-input')[0];
const subjectInput = document.getElementsByClassName('subject-input')[0];

if (classInput) {
    searchSubjectsOfClass(classInput.value);
    classInput.onchange = function() {
        searchSubjectsOfClass(classInput.value);
    }
}

function searchSubjectsOfClass(class_name) {
    axios({
        method: 'GET',
        url: `tim-chu-de/${ class_name }`
    }).then(response => {
        if (response.data && response.data.length > 0) {
            var data = response.data;
            var subjectInputHTML = data.map(
                obj => `<option value="${ obj['subject'] }">${ obj['subject'] }</option>`
            );
            subjectInput.innerHTML = `${subjectInputHTML.join("")}`;
        }
    }).catch(error => console.log(error));
}

// deletePostAPI
function deletePost(input) {
    var post_id = input[0];
    var index = input[1];
    var confirmCheck = confirm('Bạn có chắc chắn muốn xóa bài viết');
    if (confirmCheck) {
        var postTable = document.getElementsByTagName('table')[0];
        const saveContent = postTable.innerHTML;
        const removeContent = document.getElementsByTagName('tr')[index + 1].innerHTML;
        axios({
            method: 'GET',
            url: `xoa-bai/${ post_id }`
        }).then(response => {
            if (response.data) {
                postTable.innerHTML = saveContent.replace(removeContent, '');
                alert(response.data);
            }
        }).catch(error => console.log(error));
    }
}