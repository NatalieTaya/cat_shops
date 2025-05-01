const label=document.getElementById("label_cost")
const qproducts = document.getElementById('qproducts');
const slider = document.getElementById("cost")


let timeout;
slider.addEventListener('input', function() {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        const value =this.value
        label.textContent=value+"$"
    
        // Создаем FormData для удобной отправки
        const formData = new FormData();
        formData.append('slider_value', value);
        formData.append('products_data', JSON.stringify(products));
    
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

