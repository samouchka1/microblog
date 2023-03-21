

async function unlikePost(event) {
    event.preventDefault()

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
          likedButton.style.backgroundColor = '#fd7575';
          likedButton.style.border = '1px solid gray';
          likedButton.style.borderRadius = '4px';
          setTimeout(() =>{
            document.location.reload();
          }, 300);
        } else {
          likeResponse.textContent = data.message;
          setTimeout(() =>{
            likeResponse.textContent = '';
          }, 300);
        }

  }