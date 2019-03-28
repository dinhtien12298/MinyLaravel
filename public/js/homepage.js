var subjectTab = document.getElementsByClassName('subject-tab');
var tabPost = document.getElementsByClassName('tab-post');

for (let i = 0; i < subjectTab.length; i++) {
    if (i == 0 || i == 4) {
        subjectTab[i].classList.add('subject-active');
    }
    subjectTab[i].onclick = function() {
        var subjectActive = document.getElementsByClassName('subject-active');
        for (let j = 0; j < subjectActive.length; j++) {
            if (j == parseInt(i/4)) {
                subjectActive[j].classList.remove('subject-active');
            }
        }
        subjectTab[i].classList.add('subject-active');
        for (let k = 0; k < tabPost.length; k++) {
            if (k == parseInt(i/4) + 1) {
                axios({
                    method: 'GET',
                    url: proxy._searchTab + subjectTab[i].dataset.subjectid
                }).then((response) => {
                    if (response.data) {
                        var posts = response.data;
                        var tabPostHTML = posts.map(
                            post => `
                            <div class="post-model" onclick="directTo('/bai-viet/${ post.id }')">
                                <div class="post-title">
                                    <a href="/bai-viet/${ post.id }" class="f-medium-17">${ post.title }</a>
                                </div>
                                <div class="post-heading d-flex">
                                    <div class="post-author f-medium-12">
                                        ${ post.fullname }
                                    </div>
                                    <div class="post-info f-regular-13">
                                        <div><img src="/images/homepage/icon-view.png" alt="icon-view">${ post.view_num }</div>
                                        <div><img src="/images/homepage/icon-heart.png" alt="icon-like">${ post.like_num }</div>
                                    </div>
                                </div>
                                <div class="post-content f-regular-13">
                                    ${ post.content }
                                </div>
                            </div>
                        `
                        );
                        tabPost[k].innerHTML = `${tabPostHTML.join("")}`;
                    }
                }).catch(error => console.log(error));
            }
        }
    }
}