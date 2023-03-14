const commentForm = document.querySelector('#comment-form');
commentForm.addEventListener('submit', setComment);
const responseComment = document.querySelector('#comment-response');
const responseSuccess = document.querySelector('#response-success');

async function setComment(event) {
    event.preventDefault();

    const formData = new FormData(commentForm);
    const post_id = formData.get('post_id');
    const commenting_user = formData.get('commenting_user');
    const comment = formData.get('comment');

    const response = await fetch('/api/new_comment.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ post_id, commenting_user, comment }),
    });

    const data = await response.json();

    if (data.success) {
    console.log(data.success);
    responseSuccess.textContent = data.message;
    setTimeout(() => {
        document.location.reload();
      }, 300);
    } else { 
    console.log(data.message);
    responseComment.textContent = data.message;
    }
}