// Get all like buttons on the page
const likeButtons = document.querySelectorAll('.like-button');

// Add event listener to each like button
likeButtons.forEach(button => {
  button.addEventListener('click', async (event) => {

    const postId = event.target.getAttribute('data-postid');

    const response = await fetch('/api/new_like.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ post_id: postId }),
    });

    const data = await response.json();

    if (data.success) {
      const likeCountElement = document.querySelector('.like-count');
      likeCountElement.textContent = data.likeCount;
      setTimeout(() => {
        document.location.reload();
      }, 300);
    } else {
      console.error(data.message);
    }
  });
});