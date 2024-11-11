const avatarInput = document.getElementById('ava');
const avatarImage = document.getElementById('avatar-image');

avatarInput.addEventListener('change', function() {
  const file = avatarInput.files[0]; // Получаем выбранный файл
  const reader = new FileReader(); // Создаем объект для чтения файла

  reader.onload = function(e) {
    avatarImage.src = e.target.result; // Присваиваем содержимое файла к атрибуту src изображения
  }

  if (file) {
    reader.readAsDataURL(file); // Читаем содержимое файла как URL-адрес данных
  }
});