document.addEventListener('DOMContentLoaded', function() {

    const buttons = document.querySelectorAll('.comment-button');

    function showComment() {
        for (let post of document.querySelectorAll('.post')) {
            const postId = post.dataset.postId;
            fetch('?c=showPostComment&x&post_id=' + postId)
                .then(response => response.json())
                .then(data => {
                    post.querySelector('.show-comment').innerHTML = '';
                    for (let commentData of data) {
                        const meta =  document.createElement('small');
                        console.log(commentData);

                        const comment = document.createElement('div');
                        const content = document.createElement('p');

                        content.style.fontSize = '20px';
                        
                        content.textContent = commentData.contenu;
                        meta.textContent = commentData.auteur + ' ' + commentData.date_commentaire;

                        comment.appendChild(meta);
                        comment.appendChild(content);

                        comment.style.textAlign = 'left';
                        comment.style.marginLeft = '30px';
                        post.querySelector('.show-comment').appendChild(comment);
                    }
                });
        }
    }

    showComment();
});