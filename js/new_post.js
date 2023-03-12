const newPostForm = document.querySelector('#new-post-form');
newPostForm.addEventListener('submit', setNewPost);
const responseDiv = document.querySelector('#response');
const responseSuccess = document.querySelector('#response-success');


async function setNewPost(event) {
    event.preventDefault();

    const formData = new FormData(newPostForm);
    const new_post = formData.get('new_post');

    const response = await fetch('/api/new_post.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ new_post }),
    });

    const data = await response.json();

    if (data.success) {
    console.log(data.success);
    responseSuccess.textContent = 'New post created!';
    setTimeout(() => {
        document.location.reload();
      }, 300);      
    } else { 
    console.log(data.message);
    responseDiv.textContent = data.message;
    }
}