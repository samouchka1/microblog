const editPostForm = document.querySelector('#edit-post-form');
editPostForm.addEventListener('submit', setEditPost);
const responseDiv = document.querySelector('#response');
const responseSuccess = document.querySelector('#response-success');

const showEditForm = document.querySelector('#edit-form');
showEditForm.addEventListener('submit', setEditForm);

const editFormCancel = document.querySelector('#edit-form-cancel');
showEditForm.addEventListener('submit', setEditFormCancel);

async function setEditForm(event) {
    event.preventDefault();

    const formData = new FormData(showEditForm);
    const form_bool = formData.get('set_edit');
    const post_id = formData.get('post_id');

    const response = await fetch('/api/edit-post-set.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ form_bool, post_id }),
    });

    const data = await response.json();

    if (data.success) {
        console.log(data.success);
        setTimeout(() => {
            document.location.reload();
        }, 300);
    } else { 
        console.log(data.message);
    }
}

//cancel edit
async function setEditFormCancel(event) {
    event.preventDefault();

    const formData = new FormData(editFormCancel);
    const form_bool = formData.get('set_edit');
    const post_id = formData.get('post_id');

    const response = await fetch('/api/edit-post-set.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ form_bool, post_id }),
    });

    const data = await response.json();

    if (data.success) {
        console.log(data.success);
        setTimeout(() => {
            document.location.reload();
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
            window.location.href = `/page-view-post.php?post_id=${post_id}`;
        }, 300);      
    } else { 
        console.log(data.message);
        responseDiv.textContent = data.message;
    }
}