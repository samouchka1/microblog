const editPostForm = document.querySelector('#edit-post-form');
editPostForm.addEventListener('submit', setEditPost);
const responseDiv = document.querySelector('#response');
const responseSuccess = document.querySelector('#response-success');


const showEditForm = document.querySelector('#edit-form');
showEditForm.addEventListener('submit', setEditForm);

async function setEditForm(event) {
    event.preventDefault();

    const formData = new FormData(showEditForm);
    const form_bool = formData.get('set_edit');

    const response = await fetch('/api/edit-post-set', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ form_bool }),
    });

    const data = await response.json();

    if (data.success) {
        console.log(data.success);
        setTimeout(() => {
            window.location.href = "/page-view-post.php";
            }, 300);
    } else { 
        console.log(data.message);
    }
}



async function setEditPost(event) {
    event.preventDefault();

    const formData = new FormData(editPostForm);
    const edited_post = formData.get('edited_post');
    const post_id = formData.get('post_id');

    const response = await fetch('/api/edit-post.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ edited_post, post_id }),
    });

    const data = await response.json();

    if (data.success) {
    console.log(data.success);
    responseSuccess.textContent = data.message;
    setTimeout(() => {
        window.location.href = "/page-view-post.php";
      }, 300);      
    } else { 
    console.log(data.message);
    responseDiv.textContent = data.message;
    }
}