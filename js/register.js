const regForm = document.querySelector('#register-form');
regForm.addEventListener('submit', registerUser);
const responseDiv = document.querySelector('#response');

async function registerUser(event) {
  event.preventDefault();

  const formData = new FormData(regForm);
  const username = formData.get('username');
  const password = formData.get('password');
  const confirm_password = formData.get('confirm_password');
  console.log(confirm_password); //test returns correct value

  const response = await fetch('/api/register.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ username, password, confirm_password }),
  });

  const data = await response.json(); 

  if (data.success) {
    console.log(data.success);
    window.location.href = '../page.php';
  } else { 
    console.log(data.message);
    responseDiv.textContent = data.message;
  }
}