const label=document.getElementById("label_cost")
const qproducts = document.getElementById('qproducts');
const slider = document.getElementById("cost")
const form = document.getElementById("form_extended_search")
const checkboxesColors = document.querySelectorAll('input[type="checkbox"][name="colors"]');
const checkboxesCategories = document.querySelectorAll('input[type="checkbox"][name="categories"]');

let timeout;
form.addEventListener('input', function() {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        const value =slider.value
        label.textContent=value+"$"
    
        // Создаем FormData для  отправки
        const formData = new FormData();
        formData.append('slider_value', value);
        formData.append('products_data', JSON.stringify(products));


        // Добавляем обработчик к каждому чекбоксу Colors
        const id_colors = [];;
        const checked_colors= [];
        checkboxesColors.forEach(checkbox => {
            id_colors.push(checkbox.getAttribute('color_id'));
            checked_colors.push(checkbox.checked ? '1' : '0');
        });
        formData.append('id_colors', id_colors);
        formData.append('checked_colors', checked_colors);

        // Добавляем обработчик к каждому чекбоксу Categories
        const id_categories = [];;
        const checked_categories= [];
        checkboxesCategories.forEach(checkbox => {
            id_categories.push(checkbox.getAttribute('color_id'));
            checked_categories.push(checkbox.checked ? '1' : '0');
        });
        formData.append('id_categories', id_categories);
        formData.append('checked_categories', checked_categories);

        // Отправляем AJAX-запрос
        const xhr = new XMLHttpRequest(); // Создаём объект XMLHttpRequest (XHR) для отправки запросов на сервер
        xhr.open('POST', 'process.php', true); // 'POST' - метод HTTP-запроса
                                               // 'process.php' - URL серверного скрипта, который будет обрабатывать запрос
                                               // true - запрос асинхронный (не блокирует выполнение скрипта)
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                qproducts.innerHTML = xhr.responseText;
            }
        };
        xhr.send(formData); 
    }, 500); // Задержка 300 мс
});

