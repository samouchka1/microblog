const form = document.querySelector('#login-form');
form.addEventListener('submit', loginUser);

async function loginUser(event) {
  event.preventDefault();

  const formData = new FormData(form);
  const username = formData.get('username');
  const password = formData.get('password');

  const responseDiv = document.querySelector('#response');

  const response = await fetch('/api/auth.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ username, password }),
  });

  const data = await response.json();

  console.log(data);

  if (data.success) {
    console.log(data.success);
    window.location.href = '../page.php';
  } else { 
    console.log(data.message);
    responseDiv.textContent = 'Username and email not found.';
  }
}