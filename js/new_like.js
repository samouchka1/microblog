// Get all like buttons on the page
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

    const response = await fetch('/api/new_like.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ post_id: post_id, username: liking_user }),
    });

    const data = await response.json();

    if (data.success) {
    //   const likeCountElement = document.querySelector('.like-count');
    //   likeCountElement.textContent = data.likeCount;
      likedButton.style.backgroundColor = '#67db67';
      likedButton.style.border = '1px solid gray';
      likedButton.style.borderRadius = '4px';
      setTimeout(() =>{
        document.location.reload();
      }, 300);
    } else {
      console.error('Only one like allower per user.');
      likeResponse.textContent = data.message;
      setTimeout(() =>{
        likeResponse.textContent = '';
      }, 1300);
    }
  });
});