document.addEventListener('DOMContentLoaded', function() {
    let modifier_profil = document.getElementById('bouton_modifier_profil');
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

    for (let button of buttons) {
        button.addEventListener('click', function() {
            if (!button.parentElement.parentElement.parentElement.querySelector('.comment-div-show').querySelector('form')) {

                const form = document.createElement('form');
                form.action = '?c=commentMessage&post_id=' + button.dataset.postId;
                form.method = 'post';
                const textarea = document.createElement('textarea');
                textarea.classList.add('form-control');  
                textarea.style.marginTop = '10px';
                textarea.name = 'content';
                textarea.placeholder = 'Commentaire';
                textarea.required = true;
                form.appendChild(textarea);
                const formContainer = button.parentElement.parentElement.parentElement.querySelector('.comment-div-show');
                formContainer.appendChild(form);

            }else {
                const form = button.parentElement.parentElement.parentElement.querySelector('.comment-div-show').querySelector('form');
                fetch(form.action, {
                    method: form.method,
                    body: new FormData(form)
                }).then(response => {
                    showComment();
                    button.parentElement.parentElement.parentElement.querySelector('.comment-div-show').innerHTML = '';
                });

            }
        });
    }

    profil_identifiant?.addEventListener('input', (event) => {
        modifier_profil.classList.remove('d-none');
    });

    profil_mail?.addEventListener('input', (event) => {
        modifier_profil.classList.remove('d-none');
    });
});