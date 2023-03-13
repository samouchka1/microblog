const commentForm = document.querySelector('#comment-form');
commentForm.addEventListener('submit', setComment);
const responseComment = document.querySelector('#comment-response');

async function setComment(event) {
    event.preventDefault();

    const formData = new FormData(newPostForm);
    const post_id = formData.get('post_id');
    const comment = formData.get('comment');
    console.log(post_id);
    console.log(comment);

    const response = await fetch('/api/new_comment.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ post_id, comment }),
    });

    const data = await response.json();

    if (data.success) {
    console.log(data.success);
    // document.location.reload();   
    } else { 
    console.log(data.message);
    responseComment.textContent = data.message;
    }
}