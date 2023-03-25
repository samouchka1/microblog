const deletePostForm = document.querySelector('#delete-form');
deletePostForm.addEventListener('submit', setDeletePost);

async function setDeletePost(event) {
    event.preventDefault();

    const formData = new FormData(deletePostForm);
    const post_id = formData.get('post_id');
    console.log(post_id);

    const response = await fetch('/api/delete-post.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ post_id }),
    });

    const data = await response.json();

    if (data.success) {
        console.log(data.success);
        // alert('Are you sure?')
        // setTimeout(() => {
        //     window.location.href = `/page-profile.php`;
        // }, 300);   
    } else {
        console.log(data.message);
    }
}