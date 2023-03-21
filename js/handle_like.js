const likeButtons = document.querySelectorAll('.like-button');
const likedButton = document.querySelector('#liked-button');
const likeResponse = document.querySelector('#like-response');

// Add event listener to each like button
likeButtons.forEach(button => {
  button.addEventListener('click', async (event) => {

    const post_id = event.target.getAttribute('data-postid');
    const liking_user = document.getElementById('liking-user').value;

    const formData = new FormData();
    formData.append('post_id', post_id);
    formData.append('username', liking_user);

    const response = await fetch('/api/handle_like.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ post_id: post_id, username: liking_user }),
    });

    const data = await response.json();

    if (data.message === 'liked') {
      console.error('liked post.');
      likedButton.style.backgroundColor = '#67db67';
      likedButton.style.border = '1px solid gray';
      likedButton.style.borderRadius = '4px';
      setTimeout(() =>{
        document.location.reload();
      }, 300);
    } else if (data.message === 'unliked') {
      console.error('unliked post.');
      likedButton.style.backgroundColor = '#ff9393';
      likedButton.style.border = '1px solid gray';
      likedButton.style.borderRadius = '4px';
      setTimeout(() =>{
        document.location.reload();
      }, 300);
    }
  });
});